<?php

namespace App\Http\Controllers;

// use App\Models\Order;
use App\Models\SewaPerangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class OrderPerangkatController extends Controller
{
    public function index()
    {
        $sewa_perangkat = SewaPerangkat::latest()->get();
        return view('admin.transaksi.perangkat.index', compact('sewa_perangkat'));
    }
    public function pengembalian()
    {
        $sewa_perangkat = SewaPerangkat::where('proses', '=', 'Disewa')->latest()->get();
        return view('admin.pengembalian.perangkat.index', compact('sewa_perangkat'));
    }

    public function show($id)
    {
        $sewa_perangkat = SewaPerangkat::findOrfail($id);
        $start = $sewa_perangkat->tanggal_mulai;
        $end = $sewa_perangkat->tanggal_berakhir;
        $lama = Carbon::parse($start)->diffInDays(Carbon::parse($end));
        $client = env('MIDTRANS_CLIENTKEY');
        return view('admin.transaksi.perangkat.show', compact('sewa_perangkat', 'client', 'lama'));
    }
}
