<?php

namespace App\Http\Controllers;

// use App\Models\Order;
use App\Models\SewaPerangkat;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // $order = Order::join('sewa_perangkat', 'order.sewa_perangkat_id', '=', 'sewa_perangkat.id')
        //                 ->join('perangkat', 'order.perangkat_id', '=', 'perangkat.id')
        //                 // ->groupBy('sewa_perangkat_id')
        //                 ->select('order.*', 'sewa_perangkat.id', 'perangkat.nama')
        //                 ->latest()
        //                 ->get();
        $order = SewaPerangkat::latest()->get();
        return view('admin.transaksi.index', compact('order'));
    }

}
