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
}
