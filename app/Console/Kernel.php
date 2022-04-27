<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\SewaPerangkat;
use App\Models\Denda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Redirect;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            DB::transaction(function() {
                $length = 10;
                $random = '';
                for ($i = 0; $i < $length; $i++) {
                    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                }

                $invoice =  'INV-'.Str::upper($random);
                $denda = Denda::get();
                $sekarang = \Carbon\Carbon::createFromFormat('Y-m-d', now());
                if($denda->where($denda->sewa_perangkat->proses, '=', 'Disewa')->where($denda->sewa_perangkat->tanggal_berakhir < $sekarang)){
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
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
