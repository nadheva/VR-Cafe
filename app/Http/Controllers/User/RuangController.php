<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use App\Models\SewaRuang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruang  = Ruang::all();
        return view('user.sewa-ruang.index', compact('ruang'));
    }

    public function show($id)
    {
        $ruang = Ruang::where('id', $id)->first();
        $ruanglain = Ruang::latest()->take(5)->get()->except($id);
        $ruangdetails = json_decode($ruang->gambar_detail, true);
        foreach ($ruangdetails as $key => $i){
            $data[] = $i;
         }
         $sewa_ruang = SewaRuang::where('ruang_id', $id)->get();
        return view('user.sewa-ruang.show', compact('ruang', 'ruangdetails' ,'ruanglain', 'sewa_ruang'));
    }
}
