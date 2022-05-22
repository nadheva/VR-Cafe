<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaPerangkat;
use App\Models\SewaStudio;
use App\Models\Perangkat;
use App\Models\Studio;
use App\Models\Denda;
use App\Models\Resepsionis;
use App\Models\Testimonial;

class LaporanController extends Controller
{
  public function index()
  {
      $sewa_perangkat = SewaPerangkat::latest()->count();
      $sewa_studio = SewaStudio::latest()->count();
      $studio = Studio::latest()->count();
      $perangkat = Perangkat::latest()->count();
      $denda = Denda::latest()->count();
      $resepsionis = Resepsionis::latest()->count();
      $testimonial = Testimonial::latest()->count();

      return view('admin.laporan.index', compact('sewa_perangkat', 'sewa_studio', 'studio'. 'perangkat', 'denda', 'resepsionis', 'testimonial'));
  }
}
