<?php

namespace App\Http\Controllers;

// use App\Models\Order;
use App\Models\SewaPerangkat;
use Illuminate\Http\Request;

class OrderPerangkatController extends Controller
{
    public function index()
    {
        $sewa_perangkat = SewaPerangkat::latest()->get();
        return view('admin.transaksi.perangkat.index', compact('sewa_perangkat'));
    }

}
