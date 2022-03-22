<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaPerangkat;
use App\Models\SewaRuang;
use App\Models\Perangkat;
use App\Models\Ruang;
use App\Models\Denda;
use App\Models\Resepsionis;
use App\Models\Testimonial;

class LaporanController extends Controller
{
  public function index()
  {
      $sewa_perangkat = SewaPerangkat::latest()->count();
      $sewa_ruang = SewaRuang::latest()->count();
      $ruang = Ruang::latest()->count();
      $perangkat = Perangkat::latest()->count();
      $denda = Denda::latest()->count();
      $resepsionis = Resepsionis::latest()->count();
      $testimonial = Testimonial::latest()->count();

      return view('admin.laporan.index', compact('sewa_perangkat', 'sewa_ruang', 'ruang'. 'perangkat', 'denda', 'resepsionis', 'testimonial'));
  }   
}
