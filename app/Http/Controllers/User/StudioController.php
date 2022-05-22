<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\SewaStudio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studio  = Studio::all();
        return view('user.sewa-studio.index', compact('studio'));
    }

    public function show($id)
    {
        $studio = Studio::where('id', $id)->first();
        $studiolain = Studio::latest()->take(5)->get()->except($id);
        $studiodetails = json_decode($studio->gambar_detail, true);
        foreach ($studiodetails as $key => $i){
            $data[] = $i;
         }
         $sewa_studio = SewaStudio::where('studio_id', $id)->get();
        return view('user.sewa-studio.show', compact('studio', 'studiodetails' ,'studiolain', 'sewa_studio'));
    }
}
