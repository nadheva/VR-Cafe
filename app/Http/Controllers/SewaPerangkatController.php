<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaPerangkat;
use App\Models\Perangkat;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Profile;
use Midtrans\Snap;
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

        $invoice =  'INV-'.Str::upper($random);
        $user = Auth::user()->id;
        $perangkat = Perangkat::get();
        $cart = Cart::where('user_id', $user)->get();
        $total = $cart->sum('harga');

        // $this->validate($this->request, [
        //     'user_id' => 'required',
        //     'invoice' => 'required',
        //     'tanggal_mulai' => 'required',
        //     'tanggal_berakhir' =>  'required',
        //     'keperluan' => 'required',
        //     'proses' => 'required',
        //     'status' => 'required',
        //     'grand_total' => 'required'
        // ]);

        $sewa_perangkat = SewaPerangkat::create([
            // 'perangkat_id' => $perangkat,
            'user_id' => $user,
            'invoice' => $invoice,
            'tanggal_mulai' => $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $this->request->tanggal_mulai),
            'tanggal_berakhir' =>  $sampai= \Carbon\Carbon::createFromFormat('Y-m-d', $this->request->tanggal_berakhir),
            'keperluan' => $this->request->keperluan,
            'proses' => 'Disewa',
            'status' => 'pending',
            'grand_total' => ($mulai->diffInDays($sampai)) * $total
        ]);

        foreach(Cart::where('user_id', Auth::user()->id)->get() as $cart) {
            $perangkat->where('id', $cart->perangkat->id);
            foreach (Perangkat::where('id', $cart->perangkat->id)->get() as $i)
            $i->stok = $i->stok - $cart->jumlah;
            $i->save();

            $sewa_perangkat->order()->create([
            'sewa_perangkat_id' => $sewa_perangkat->id,
            'perangkat_id'      => $cart->perangkat_id,
            'jumlah'            => $cart->jumlah,
            'harga'             => $cart->harga,
            ]);


        }

        $payload = [
            'transaction_details' => [
                'order_id' => $sewa_perangkat->invoice,
                'gross_amount' => $sewa_perangkat->grand_total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        ];

        //snap token
        $snapToken = Snap::getSnapToken($payload);
        $sewa_perangkat->snap_token = $snapToken;
        $sewa_perangkat->save();

        $this->response['id'] = $sewa_perangkat;

        });
        return redirect('pembayaran', response()->json($this->response->id));

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
        $data_transaction = SewaPerangkat::where('invoice', $orderId)->first();

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


        } elseif ($transaction == 'deny') {


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

    public function pembayaran($id)
    {
        // $sewa_perangkat = SewaPerangkat::where('id',$id)->first();
        $sewa_perangkat = SewaPerangkat::find($id);
        return view('user.cart.pembayaran', compact('sewa_perangkat'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $sewa_perangkat = SewaPerangkat::find($id);
        $order = Order::where('id', $id)->first();
        // $perangkat = Perangkat::all();
        $sewa_perangkat->update([
            'proses' => 'Dikembalikan'
        ]);

        // $sewa_perangkat->perangkat->where('id', $sewa_perangkat->perangkat->id )
        //                           ->update([
        //                               'stok' => ($sewa_perangkat->perangkat->stok +  1)
        //                           ]);
        foreach(Order::where('id', $id)->get() as $order) {
        Perangkat::where('id', $order->perangkat->id)
            ->update([
                'stok' => (Perangkat::select('stok') + $order->jumlah),
            ]);
        }
        return redirect()->route('sewa_perangkat.index')
                ->with('success', 'Perangkat berhasil dikembalikan!');
    }

    public function destroy($id)
    {
        SewaPerangkat::find($id)->delete();
        return redirect()->back();
    }


}
