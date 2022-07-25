<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaStudio;
use App\Models\Studio;
use App\Models\Profile;
use Midtrans\Snap;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SewaStudioController extends Controller
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
        $id1 = decrypt($id);
        $user = Auth::user()->id;
        $profil = Profile::where('user_id', $user)->first();
        if(is_null($profil)){
            return redirect()->route('profil.create')
            ->with('danger', 'Anda belum menambahkan data profil!');
        } else {
        $studio = Studio::where('id', $id1)->first();
        return view('user.sewa-studio.checkout', compact('studio', 'profil'));
        }
    }

    public function store()
    {
        $validator = Validator::make($this->request->all(),
                    [
                        'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
                        'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
                    ],

                [
                    'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
                    'tanggal_mulai.date' => 'Tanggal tidak valid!',
                    'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir',

                    'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi',
                    'tanggal_berakhir.date' => 'Tanggal tidak valid!',
                    'tanggal_berakhir.after_or_equal' => 'Tanggal mulai harus setara atau setelah tanggal mulai!'
                ],
            );
            if($validator->fails()) {
                Alert::warning('Warning', 'Mohon inputkan waktu mulai dan waktu selesai dengan benar!');
                return back();
            }
            if(((Carbon::parse($this->request->tanggal_mulai)->diffInMinutes(Carbon::parse($this->request->tanggal_berakhir)))/60) < 1) {
                Alert::warning('Warning', 'Mohon inputkan waktu mulai dan waktu selesai dengan benar!');
                return back();
            }
            $studio = Studio::find($this->request->studio_id);
            $tanggal_mulai = $this->request->tanggal_mulai;
            $already_booked = false;
            foreach ($studio->sewa_studio as $sewa) {
                $from = Carbon::parse($sewa->tanggal_mulai);
                $to =   Carbon::parse($sewa->tanggal_berakhir);

                $already_booked = Carbon::parse($tanggal_mulai)->between($from, $to);
                if ($already_booked){
                    Alert::info('Info', 'Maaf studio tersebut sudah dibooking pada waktu tersebut, silahkan pilih waktu lain!');
                    return back();
            }
        }

        DB::transaction(function($id) {

            //cek ketersediaan
            $studio = Studio::find($this->request->studio_id);
            $this->request->validate([
                'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
                'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai'
            ],
            [
                'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
                'tanggal_mulai.date' => 'Tanggal tidak valid!',
                'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir',

                'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi',
                'tanggal_berakhir.date' => 'Tanggal tidak valid!',
                'tanggal_berakhir.after_or_equal' => 'Tanggal mulai harus setara atau setelah tanggal mulai!'
            ],
            );
            $tanggal_mulai = $this->request->tanggal_mulai;
            $already_booked = false;
            foreach ($studio->sewa_studio as $sewa) {
                $from = Carbon::make($sewa->tanggal_mulai);
                $to =   Carbon::make($sewa->tanggal_berakhir);

                $already_booked = Carbon::make($tanggal_mulai)->between($from, $to);
            }

            if ($already_booked)
                return redirect()->route('user-studio.index')->with('warning',
                    'Maaf studio tersebut sudah dibooking pada waktu tersebut, silahkan pilih waktu lain.'
            );

            $length = 10;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }

            $invoice =  'INV-'.Str::upper($random);
            $user = Auth::user()->id;
            $studio = Studio::where('id', $this->request->studio_id)->first();

            $sewa_studio = SewaStudio::create([
                'studio_id' => $this->request->studio_id,
                'user_id' => $user,
                'invoice' => $invoice,
                'tanggal_mulai' => $mulai = Carbon::make($this->request->tanggal_mulai),
                'tanggal_berakhir' =>  $sampai = Carbon::make($this->request->tanggal_berakhir),
                'keperluan' => $this->request->keperluan,
                'proses' => 'Dalam Proses',
                'grand_total' => (($mulai->diffInMinutes($sampai))/60) * $studio->harga,
                'approval' => '0'
            ]);

            $payment =  $sewa_studio->payment()->create([
                'invoice' => $sewa_studio->invoice,
                'status' => 'pending',
                'grand_total' => $sewa_studio->grand_total,
                'user_id' => $sewa_studio->user_id
            ]);

                // $sewa_studio->studio->where('id', $sewa_studio->studio_id)
                // ->update([
                //     'jumlah' => ($sewa_studio->studio->jumlah - 1)
                // ]);

            $payload = [
                'transaction_details' => [
                    'order_id' => $sewa_studio->invoice,
                    'gross_amount' => $sewa_studio->grand_total,
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

            Alert::success('Success', 'Sewa Studio berhasil ditambahkan!');
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
        $data_transaction = SewaStudio::where('invoice', $orderId)->first();

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

    public function approve($id)
    {
        $sewa_studio = SewaStudio::findOrfail($id);
        $sewa_studio->update([
            'approval' => '1',
            'proses' => 'Disewa'
        ]);
        Alert::success('Success', 'Pengajuan sewa studio berhasil disetujui!');
        return redirect()->back();
    }

    public function deny($id)
    {
        $sewa_studio = SewaStudio::findOrfail($id);
        $sewa_studio->update([
            'approval' => '0',
            'proses' => 'Ditolak'
        ]);
        Alert::info('Warning', 'Pengajuan sewa studio berhasil ditolak!');
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $sewa_studio = SewaStudio::findOrFail($id);
        $sewa_studio->update([
            'proses' => 'Dikembalikan'
        ]);

        // $sewa_studio->studio->where('id', $sewa_studio->studio->id)
        //                 ->update([
        //                     'jumlah' => ($sewa_studio->studio->jumlah + 1),
        //                     ]);
        // return redirect()->route('pengembalian-studio')
        //         ->with('success', 'Studio berhasil dikembalikan!');
        Alert::info('Info', 'Studio berhasil dikembalikan!');
        return redirect()->back();
    }


    public function destroy($id)
    {
        SewaStudio::findOrfail($id)->delete();
        Alert::warning('Warning', 'Transaksi sewa studio berhasil dihapus!');
        return redirect()->back();

    }

    public function cek_studio(Request $request)
    {
        $studio = Studio::find($request->studio_id);
        $validator = Validator::make($request->all(),[
                        'tanggal_mulai' => 'required|date|before:tanggal_berakhir',
                        'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
                    ],

                [
                    'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
                    'tanggal_mulai.date' => 'Tanggal tidak valid!',
                    'tanggal_mulai.before' => 'Tanggal mulai harus sebelum tanggal berakhir',

                    'tanggal_berakhir.required' => 'Tanggal berakhir wajib diisi',
                    'tanggal_berakhir.date' => 'Tanggal tidak valid!',
                    'tanggal_berakhir.after_or_equal' => 'Tanggal mulai harus setara atau setelah tanggal mulai!'
                ],
            );
            if ($validator->fails()) {
                Alert::warning('Warning', 'Mohon inputkan waktu mulai dan waktu selesai dengan benar!');
                return back();
            }
        $tanggal_mulai = $request->tanggal_mulai;
        $already_booked = false;
        foreach ($studio->sewa_studio as $sewa) {
            $from = Carbon::make($sewa->tanggal_mulai);
            $to =   Carbon::make($sewa->tanggal_berakhir);

            $already_booked = Carbon::make($tanggal_mulai)->between($from, $to);
        }

        if ($already_booked){
            Alert::warning('Warning', 'Maaf studio tersebut sudah dibooking pada waktu tersebut, silahkan pilih waktu lain!');
            return redirect()->back();}
        else{
        Alert::info('Info', 'studio tersedia pada waktu tersebut, silahkan booking!');
        return redirect()->back();
    }
    }
}
