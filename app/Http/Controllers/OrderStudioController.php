<?php

namespace App\Http\Controllers;

use App\Models\SewaRuang;
use Illuminate\Http\Request;

class OrderStudioController extends Controller
{
    public function index()
    {
        $sewa_ruang = SewaRuang::latest()->get();
        return view('admin.transaksi.studio.index', compact('sewa_ruang'));
    }

    public function pengembalian()
    {
        $sewa_ruang = SewaRuang::where('proses', '==', 'Disewa')->latest()->get();
        return view('admin.pengembalian.studio.index', compact('sewa_ruang'));
    }

    public function show($id)
    {
        $sewa_studio = SewaRuang::findOrfail($id);
        $client = env('MIDTRANS_CLIENTKEY');
        return view('admin.transaksi.studio.show', compact('sewa_studio', 'client'));
    }
}
