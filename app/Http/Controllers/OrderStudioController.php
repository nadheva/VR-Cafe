<?php

namespace App\Http\Controllers;

use App\Models\SewaStudio;
use Illuminate\Http\Request;

class OrderStudioController extends Controller
{
    public function index()
    {
        $sewa_studio = SewaStudio::latest()->get();
        return view('admin.transaksi.studio.index', compact('sewa_studio'));
    }

    public function pengembalian()
    {
        $sewa_studio = SewaStudio::where('proses', '=', 'Disewa')->latest()->get();
        return view('admin.pengembalian.studio.index', compact('sewa_studio'));
    }

    public function show($id)
    {
        $sewa_studio = SewaStudio::findOrfail($id);
        $client = env('MIDTRANS_CLIENTKEY');
        return view('admin.transaksi.studio.show', compact('sewa_studio', 'client'));
    }
}
