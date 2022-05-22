<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaRuang;
use App\Models\Ruang;
use App\Models\Profile;
use Midtrans\Snap;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class SewaRuangController extends Controller
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

    }

    public function create($id)
    {
        $user = Auth::user()->id;
        $profil = Profile::where('user_id', $user)->first();
        if(is_null($profil)){
            return redirect()->route('profil.create')
            ->with('danger', 'Anda belum menambahkan data profil!');
        } else {
        $ruang = Ruang::where('id', $id)->first();
        return view('user.sewa-ruang.checkout', compact('ruang', 'profil'));
        }
    }

    public function store()
    {
        DB::transaction(function($id) {

            //cek ketersediaan
            $studio = Ruang::find($this->request->ruang_id);
            $this->request->validate([
                'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
                'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai'
            ],
            [
                'tanggal_mulai' => 'required|time|before:tanggal_berakhir',
                'tanggal_berakhir' => 'required|time|after:tanggal_mulai'
            ]);
            $tanggal_mulai = $this->request->tanggal_mulai;
            $already_booked = false;
            foreach ($studio->sewa_ruang as $sewa) {
                $from = Carbon::make($sewa->tanggal_mulai);
                $to =   Carbon::make($sewa->tanggal_berakhir);

                $already_booked = Carbon::make($tanggal_mulai)->between($from, $to);
            }

            if ($already_booked)
                return redirect()->route('user-ruang.index')->with('warning',
                    'Maaf ruangan tersebut sudah dibooking pada waktu tersebut, silahkan pilih waktu lain.'
            );

            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $invoice =  'INV-'.Str::upper($random);
            $user = Auth::user()->id;
            $ruang = Ruang::where('id', $this->request->ruang_id)->first();

            $sewa_ruang = SewaRuang::create([
                'ruang_id' => $this->request->ruang_id,
                'user_id' => $user,
                'invoice' => $invoice,
                'tanggal_mulai' => $mulai = Carbon::make($this->request->tanggal_mulai),
                'tanggal_berakhir' =>  $sampai = Carbon::make($this->request->tanggal_berakhir),
                'keperluan' => $this->request->keperluan,
                'proses' => 'Disewa',
                'grand_total' => (($mulai->diffInMinutes($sampai))/60) * $ruang->harga
            ]);

            $payment =  $sewa_ruang->payment()->create([
                'invoice' => $sewa_ruang->invoice,
                'status' => 'pending',
                'grand_total' => $sewa_ruang->grand_total,
                'user_id' => $sewa_ruang->user_id
            ]);

                // $sewa_ruang->studio->where('id', $sewa_ruang->ruang_id)
                // ->update([
                //     'jumlah' => ($sewa_ruang->studio->jumlah - 1)
                // ]);

            $payload = [
                'transaction_details' => [
                    'order_id' => $sewa_ruang->invoice,
                    'gross_amount' => $sewa_ruang->grand_total,
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
            return redirect()->route('user-transaksi-studio.index');
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
        $data_transaction = SewaRuang::where('invoice', $orderId)->first();

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

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $sewa_ruang = SewaRuang::findOrFail($id);
        $sewa_ruang->update([
            'proses' => 'Dikembalikan'
        ]);

        // $sewa_ruang->studio->where('id', $sewa_ruang->studio->id)
        //                 ->update([
        //                     'jumlah' => ($sewa_ruang->studio->jumlah + 1),
        //                     ]);
        return redirect()->route('pengembalian-studio')
                ->with('success', 'Studio berhasil dikembalikan!');
    }


    public function destroy($id)
    {

    }

    public function cek_studio(Request $request)
    {
        $studio = Ruang::find($request->ruang_id);
        $validator = Validator::make([
                        'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
                        'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
                    ],
                    [
                        'tanggal_mulai' => 'required|time|before:tanggal_berakhir',
                        'tanggal_berakhir' => 'required|time|after:tanggal_mulai'
                    ],
                [
                    'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
                    'tanggal_mulai.date' => 'Tanggal tidak valid!',
                    'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir',

                    'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi',
                    'tanggal_berakhir.date' => 'Tanggal tidak valid!',
                    'tanggal_berakhir.after_or_equal' => 'Tanggal mulai harus setara atau setelah tanggal mulai!'
                ],
                [
                    'tanggal_mulai.time' => 'Waktu tidak valid!',
                    'tanggal_mulai.before' => 'waktu mulai harus sebelum waktu berakhir',

                    'tanggal_berakhir.time' => 'Waktu tidak valid!',
                    'tanggal_berakhir.after' => 'Waktu berakhir harus setelah waktu mulai!'
                ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
            }
        $tanggal_mulai = $request->tanggal_mulai;
        $already_booked = false;
        foreach ($studio->sewa_ruang as $sewa) {
            $from = Carbon::make($sewa->tanggal_mulai);
            $to =   Carbon::make($sewa->tanggal_berakhir);

            $already_booked = Carbon::make($tanggal_mulai)->between($from, $to);
        }

        if ($already_booked){
            return redirect()->back()->with('warning',
                'Maaf ruangan tersebut sudah dibooking pada waktu tersebut, silahkan pilih waktu lain.'
        );}
        else{
        return redirect()->back()->with('info',
        'Ruangan tersedia pada waktu tersebut, silahkan booking!'
        );
    }
    }
}
