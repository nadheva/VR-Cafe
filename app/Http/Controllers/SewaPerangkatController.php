<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaPerangkat;
use App\Models\Invoice;
use App\Models\Perangkat;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Payment;
use Midtrans\Snap;
use App\Models\Denda;
use App\Models\SewaRuang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;

class SewaPerangkatController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth')->except('notificationHandler');

        $this->request = $request;
        // Set midtrans configuration
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $user = Auth::user()->id;
        $profil = Profile::where('user_id', $user)->first();
        if(is_null($profil)){
            return redirect()->route('profil.create')
            ->with('danger', 'Anda belum menambahkan data profil!');
        } else {
        $cart = Cart::where('user_id', $user)->get();
        $total = $cart->sum('harga');
        return view('user.cart.checkout', compact('cart', 'profil', 'total'));
        }
    }

    public function create($id)
    {
        $perangkat = Perangkat::where('id', $id)->first();
        return view('user.sewa-perangkat.sewa', compact('perangkat'));
    }

    public function store()
    {
        DB::transaction(function() {
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $no_invoice =  'INV-'.Str::upper($random);
        $user = Auth::user()->id;
        $perangkat = Perangkat::get();
        $cart = Cart::where('user_id', $user)->get();
        $total = $cart->sum('harga');

        $sewa_perangkat = SewaPerangkat::create([
            'user_id' => $user,
            'invoice' => $no_invoice,
            'tanggal_mulai' => $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $this->request->tanggal_mulai),
            'tanggal_berakhir' =>  $sampai= \Carbon\Carbon::createFromFormat('Y-m-d', $this->request->tanggal_berakhir),
            'keperluan' => $this->request->keperluan,
            'denda' => '0',
            'proses' => 'Disewa',
            'grand_total' => ($mulai->diffInDays($sampai)) * $total
        ]);

      $payment =  $sewa_perangkat->payment()->create([
            'invoice' => $sewa_perangkat->invoice,
            'status' => 'pending',
            'grand_total' => $sewa_perangkat->grand_total
        ]);

        foreach(Cart::where('user_id', Auth::user()->id)->get() as $cart) {
            $perangkat->where('id', $cart->perangkat->id);
            foreach (Perangkat::where('id', $cart->perangkat->id)->get() as $i)
            $i->stok = $i->stok - $cart->jumlah;
            $i->save();

            $invoice->order()->create([
            'invoice_id' => $invoice->id,
            'perangkat_id'      => $cart->perangkat_id,
            'jumlah'            => $cart->jumlah,
            'harga'             => $cart->harga,
            ]);

        }

        $payload = [
            'transaction_details' => [
                'order_id' => $payment->invoice,
                'gross_amount' => $payment->grand_total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        //snap token
        $snapToken = Snap::getSnapToken($payload);
        $payment->snap_token = $snapToken;
        $payment->save();

        // $this->response['id'] = $sewa_perangkat;

        });
        Cart::with('perangkat')
        ->where('user_id', Auth::user()->id)
        ->delete();
        return redirect()->route('user-transaksi-perangkat.index');

    }

    public function notificationHandler(Request $request)
    {
        $payload      = $request->getContent();
        $notification = json_decode($payload);

        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transaction  = $notification->transaction_status;
        $type         = $notification->payment_type;
        $orderId      = $notification->order_id;
        $fraud        = $notification->fraud_status;

        //data tranaction
        $data_transaction = Payment::where('invoice', $orderId)->first();
        // $data_transaction1 = SewaRuang::where('invoice', $orderId)->first();
        // $data_transaction2 = Denda::where('invoice', $orderId)->first();

        if ($transaction == 'capture') {

            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {

              if($fraud == 'challenge') {

                /**
                *   update invoice to pending
                */
                $data_transaction->update([
                    'status' => 'pending'
                ]);

              } else {

                /**
                *   update invoice to success
                */
                $data_transaction->update([
                    'status' => 'success'
                ]);

              }

            }

        } elseif ($transaction == 'settlement') {

            /**
            *   update invoice to success
            */
            $data_transaction->update([
                'status' => 'success'
            ]);


        } elseif($transaction == 'pending'){


            /**
            *   update invoice to pending
            */
            $data_transaction->update([
                'status' => 'pending'
            ]);



        } elseif ($transaction == ('failure')) {


            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);


        } elseif ($transaction == 'expire') {


            /**
            *   update invoice to expired
            */
            $data_transaction->update([
                'status' => 'expired'
            ]);


        } elseif ($transaction == 'cancel') {

            /**
            *   update invoice to failed
            */
            $data_transaction->update([
                'status' => 'failed'
            ]);

        }

    }

    public function show($id)
    {
        // $sewa_perangkat = SewaPerangkat::where('id',$id)->first();
        $sewa_perangkat = SewaPerangkat::find($id);
        return view('user.transaksi.show', compact('sewa_perangkat'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $sewa_perangkat = SewaPerangkat::findOrFail($id);
        $perangkat = Perangkat::get();
        $sewa_perangkat->update([
            'proses' => 'Dikembalikan'
        ]);

        foreach(Order::where('sewa_perangkat_id', $id)->get() as $order) {
          $perangkat->where('id', $order->perangkat->id);
          foreach (Perangkat::where('id', $order->perangkat->id)->get() as $i)
          $i->stok = $i->stok + $order->jumlah;
          $i->save();
        }
        return redirect()->route('pengembalian-perangkat')
                ->with('success', 'Perangkat berhasil dikembalikan!');
    }

    public function destroy($id)
    {
        SewaPerangkat::find($id)->delete();
        return redirect()->back();
    }


}
