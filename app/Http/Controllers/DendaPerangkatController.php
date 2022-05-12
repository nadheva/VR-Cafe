<?php

namespace App\Http\Controllers;
use App\Models\Denda;
use App\Models\SewaPerangkat;
use App\Models\Perangkat;
use App\Models\Payment;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DendaPerangkatController extends Controller
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

    public function store()
    {
        DB::transaction(function() {
            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
        $invoice =  'INV-'.Str::upper($random);
        $denda = Denda::create([
            'sewa_perangkat_id' => $this->request->sewa_perangkat_id,
            'user_id' => $this->request->user_id,
            'invoice' => $invoice,
            'grand_total' => $this->request->grand_total
        ]);

        $payment =  $denda->payment()->create([
            'invoice' => $denda->invoice,
            'status' => 'pending',
            'grand_total' => $denda->grand_total,
            'user_id' => $denda->user_id
        ]);

        $payload = [
            'transaction_details' => [
                'order_id' => $payment->invoice,
                'gross_amount' => $payment->grand_total,
            ],
            'customer_details' => [
                'first_name' => $denda->user->name,
                'email' => $denda->user->email,
            ]
        ];
                //snap token
                $snapToken = Snap::getSnapToken($payload);
                $payment->snap_token = $snapToken;
                $payment->save();

                });
            return redirect()->back()
            ->with('info', 'Denda telah ditambahkan!');
        }
    }
