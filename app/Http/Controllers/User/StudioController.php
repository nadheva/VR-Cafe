<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\SewaStudio;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudioController extends Controller
{
    public function index()
    {
        $studio  = Studio::all();
        return view('user.sewa-studio.index', compact('studio'));
    }

    public function show($id)
    {
        $id1 = decrypt($id);
        $studio = Studio::where('id', $id1)->first();
        $studiolain = Studio::latest()->take(5)->get()->except($id1);
        $studiodetails = json_decode($studio->gambar_detail, true);
        foreach ($studiodetails as $key => $i){
            $data[] = $i;
         }
         $sewa_studio = SewaStudio::where('studio_id', $id1)->get();
        return view('user.sewa-studio.show', compact('studio', 'studiodetails' ,'studiolain', 'sewa_studio'));
    }
}
