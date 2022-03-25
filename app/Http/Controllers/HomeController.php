<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resepsionis;
use App\Models\Ruang;
use App\Models\Perangkat;
use App\Models\Testimonial;
use App\Models\VR_Room;

class HomeController extends Controller
{
    public function index()
    {
        $resepsionis = Resepsionis::all();
        $ruang = Ruang::all();
        $perangkat = Perangkat::all();
        $testimonial = Testimonial::all();
        return view('guest.index', compact('resepsionis', 'ruang', 'perangkat', 'testimonial'));
    }

    public function about()
    {
        return view('guest.about.about');
    }

    public function perangkat()
    {
        $perangkat = Perangkat::all()->latest();
        return view('guest.perangkat.perangkat', compact('perangkat'));
    }

    public function detail_perangkat($id)
    {
        $perangkat = Perangkat::where('id', $id)->first();
        return view('guest.perangkat.detail-perangkat', compact('perangkat'));
    }

    public function ruang()
    {
        $ruang = Ruang::all()->latest();
        return view('guest.ruang.ruang', compact('ruang'));
    }

    public function detail_ruang($id)
    {
        $ruang = Ruang::all()->latest();
        return view('guest.ruang.ruang-detail', compact('ruang'));
    }

    public function contact()
    {
        return view('guest.contact.contact');
    }

    public function resepsionis()
    {
        $resepsionis = Resepsionis::all()->latest();
        return view('guest.resepsionis.resepsionis', compact('resepsionis'));
    }

    public function detail_resepsionis($id)
    {
        $resepsionis = Resepsionis::where('id', $id)->first();
        return view('guest.resepsionis.resepsionis-detail', compact('resepsionis'));
    }

    public function vr_room()
    {
        $vr_room = VR_Room::all()->latest();
        return view('guest.vr-room.vr-room', compact('vr_room'));
    }

}
