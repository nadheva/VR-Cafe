<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
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
        return view('user.sewa-ruang.show', compact('ruang', 'ruangdetails' ,'ruanglain'));
    }
}
