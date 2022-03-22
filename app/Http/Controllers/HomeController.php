<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resepsionis;
use App\Models\Ruang;
use App\Models\Perangkat;
use App\Models\Testimonial;

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
}
