<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Snap;
use App\Models\Denda;
use Illuminate\Support\Carbon;

class DendaController extends Controller
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

    public  function index()
    {
        $denda = Denda::latest()->get();
        return view('admin.denda.index', compact('denda'));
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
            $denda = Denda::all();
            $sekarang = \Carbon\Carbon::createFromFormat('Y-m-d', now());
            if($denda->where($denda->sewa_perangkat->proses, '=', 'Disewa')->whereRaw($denda->sewa_perangkat->tanggal_berakhir < $sekarang)){
                $denda->update([
                    'grand_total' =>$denda->sewa_perangkat->grand_total * (($denda->sewa_perangkat->tanggal_berakhir)->diffInDays($sekarang)),
                    'invoice' => $invoice
                ]);
                $payload = [
                    'transaction_details' => [
                        'order_id' => $denda->invoice,
                        'gross_amount' => $denda->grand_total,
                    ],
                    'customer_details' => [
                        'first_name' => $denda->sewa_perangkat->user->name,
                        'email' => $denda->sewa_perangkat->user->email,
                    ]
                ];

                //snap token
                $snapToken = Snap::getSnapToken($payload);
                $denda->snap_token = $snapToken;
                $denda->save();

        }

    });
        // return redirect()->route('denda.index')
        // ->with('success', 'Denda Berhasil Ditambahkan!');
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
        $data_transaction = Denda::where('invoice', $orderId)->first();

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

    public function update(Request $request, $id)
    {
        DB::transaction(function(Request $request, $id){
        $denda = Denda::findOrfail($id);
        $denda->order_id = $request->order_id;
        $denda->grand_total = $request->grand_total;
        $denda->save();
    });
        return redirect()->route('denda.index')
        ->with('success', 'Denda Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Denda::find($id)->delete();
        return redirect()->route('denda.index')
        ->with('success', 'Denda Berhasil Dihapus!');
    }
}
