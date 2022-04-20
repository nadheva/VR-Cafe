<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perangkat;

class PerangkatController extends Controller
{
    public function index()
    {
        $perangkat  = Perangkat::all();
        return view('user.sewa-perangkat.index', compact('perangkat'));
    }

    public function show($id)
    {
        $perangkat = Perangkat::where('id', $id)->first();
        $perangkatlain = Perangkat::latest()->take(5)->get()->except($id);
        $perangkatdetails = json_decode($perangkat->gambar_detail, true);
        foreach ($perangkatdetails as $key => $i){
            $data[] = $i;
         }
        return view('user.sewa-perangkat.show', compact('perangkat', 'perangkatdetails' ,'perangkatlain'));
    }
}
