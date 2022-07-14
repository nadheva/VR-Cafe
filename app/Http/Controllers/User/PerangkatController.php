<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perangkat;
use App\Models\Wishlist;
use RealRashid\SweetAlert\Facades\Alert;

class PerangkatController extends Controller
{
    public function index()
    {
        $perangkat  = Perangkat::all();
        return view('user.sewa-perangkat.index', compact('perangkat'));
    }

    public function show($id)
    {
        $id1 = decrypt($id);
        $perangkat = Perangkat::where('id', $id1)->first();
        $perangkatlain = Perangkat::latest()->take(5)->get()->except($id1);
        $perangkatdetails = json_decode($perangkat->gambar_detail, true);
        foreach ($perangkatdetails as $key => $i){
            $data[] = $i;
         }
         $wishlist = Wishlist::where('perangkat_id', $id1)->first();
        return view('user.sewa-perangkat.show', compact('perangkat', 'perangkatdetails' ,'perangkatlain', 'wishlist'));
    }
}
