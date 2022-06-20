<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\SewaStudio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderStudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewa_studio = SewaStudio::where('user_id', Auth::user()->id)->latest()->get();
        return view('user.transaksi.studio.index', compact('sewa_studio'));
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
        $sewa_studio = SewaStudio::findOrfail($id);
        // $lama = $sewa_studio->tanggal_mulai->diffInHours($sewa_studio->tanggal_selesai);
        $start = $sewa_studio->tanggal_mulai;
        $end = $sewa_studio->tanggal_berakhir;
        $lama = Carbon::parse($start)->diffInHours(Carbon::parse($end));
        $client = env('MIDTRANS_CLIENTKEY');
        return view('user.transaksi.studio.show', compact('sewa_studio', 'client', 'lama'));
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
        $sewa_studio = SewaStudio::findOrfail($id);
        $mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $sewa_studio->tanggal_mulai);
        $selesai = \Carbon\Carbon::createFromFormat('Y-m-d', $sewa_studio->tanggal_berakhir);
        $hari = $mulai->diffInDays($selesai);
        return view('user.transaksi.studio.invoice', compact('sewa_studio', 'hari'));
    }
}
