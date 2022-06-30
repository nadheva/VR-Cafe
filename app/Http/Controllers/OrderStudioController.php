<?php

namespace App\Http\Controllers;

use App\Models\SewaStudio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderStudioController extends Controller
{
    public function index()
    {
        $sewa_studio = SewaStudio::latest()->get();
        // $sewa_studio = SewaStudio::get();
        // $start = $sewa_studio->tanggal_mulai;
        // $end = $sewa_studio->tanggal_berakhir;
        // $lama = Carbon::parse($start)->diffInHours(Carbon::parse($end));
        return view('admin.transaksi.studio.new', compact('sewa_studio'));
    }

    public function pengembalian()
    {
        $sewa_studio = SewaStudio::where('proses', '=', 'Disewa')->latest()->get();
        return view('admin.pengembalian.studio.index', compact('sewa_studio'));
    }

    public function show($id)
    {
        $id1 = decrypt($id);
        $sewa_studio = SewaStudio::findOrfail($id1);
        $start = $sewa_studio->tanggal_mulai;
        $end = $sewa_studio->tanggal_berakhir;
        $lama = Carbon::parse($start)->diffInHours(Carbon::parse($end));
        $client = env('MIDTRANS_CLIENTKEY');
        return view('admin.transaksi.studio.show', compact('sewa_studio', 'client', 'lama'));
    }
}
