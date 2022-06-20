<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SewaPerangkat;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderPerangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewa_perangkat = SewaPerangkat::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.transaksi.perangkat.index', compact('sewa_perangkat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sewa_perangkat = SewaPerangkat::findOrfail($id);
        $start = $sewa_perangkat->tanggal_mulai;
        $end = $sewa_perangkat->tanggal_berakhir;
        $lama = Carbon::parse($start)->diffInDays(Carbon::parse($end));
        $client = env('MIDTRANS_CLIENTKEY');
        return view('user.transaksi.perangkat.show', compact('sewa_perangkat', 'client', 'lama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoice($id)
    {
        $sewa_perangkat = SewaPerangkat::findOrfail($id);
        $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $sewa_perangkat->tanggal_mulai);
        $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $sewa_perangkat->tanggal_berakhir);
        $hari = $mulai->diffInDays($selesai);
        return view('user.transaksi.perangkat.invoice', compact('sewa_perangkat', 'hari'));
        // $pdf = PDF::loadView('user.transaksi.perangkat.invoice', compact('sewa_perangkat', 'hari'))->setOptions(['defaultFont' => 'nucleo']);;
        // return $pdf->download($sewa_perangkat->invoice.'.pdf');
    }
}
