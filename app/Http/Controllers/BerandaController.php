<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resepsionis;
use App\Models\Studio;
use App\Models\Perangkat;
use App\Models\Testimonial;
use App\Models\Artikel;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{

    public function index()
    {
        $resepsionis = Resepsionis::latest()->take(3)->get();
        $studio = Studio::latest()->take(5)->get();
        $perangkat = Perangkat::latest()->take(5)->get();
        $testimonial = Testimonial::latest()->take(5)->get();
        $artikel = Artikel::latest()->take(5)->get();
        return view('guest.index', compact('resepsionis', 'studio', 'perangkat', 'testimonial', 'artikel'));
    }

    public function about()
    {
        return view('guest.about.about');
    }

    public function perangkat()
    {
        $perangkat = Perangkat::all();
        return view('guest.perangkat.perangkat', compact('perangkat', 'deva'));
    }

    public function detail_perangkat($id)
    {
        $perangkat = Perangkat::where('id', $id)->first();
        return view('guest.perangkat.detail-perangkat', compact('perangkat'));
    }

    public function studio()
    {
        $studio = Studio::all();
        return view('guest.studio.studio', compact('studio'));
    }

    public function detail_studio($id)
    {
        $studio = Studio::where('id', $id)->first();
        return view('guest.studio.studio-detail', compact('studio'));
    }

    public function contact()
    {
        return view('guest.contact.contact');
    }

    public function resepsionis()
    {
        $resepsionis = Resepsionis::all();
        return view('guest.resepsionis.resepsionis', compact('resepsionis'));
    }

    public function detail_resepsionis($id)
    {
        $resepsionis = Resepsionis::where('id', $id)->first();
        return view('guest.resepsionis.resepsionis-detail', compact('resepsionis'));
    }

    public function artikel()
    {
        $artikel = Artikel::all();
        return view('guest.artikel.artikel', compact('artikel'));
    }

    public function detail_artikel($id)
    {
        $artikel = Artikel::where('id', $id)->first();
        return view('guest.artikel.artikel-detail', compact('artikel'));
    }

    public function vr_room()
    {
        // $vr_room = VR_Room::all()->latest();
        return view('guest.vr-room.vr-room');
    }
}
