<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use App\Models\SewaPerangkat;
use App\Models\SewaStudio;
use App\Models\Denda;
use Illuminate\Validation\Rules\Exists;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            Alert::success('Welcome', 'Selamat datang di dashboard admin!');
            $user = Auth::user()->role == 'user';
            $studio = SewaStudio::where('proses', '=', 'Disewa');
            $perangkat = SewaPerangkat::where('proses', '=', 'Disewa');
            $denda = Denda::whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month);
            $total = Payment::whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->sum('grand_total');
            $success = Payment::where('status', '=', 'success')->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month);
            $pending = Payment::where('status', '=', 'pending')->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month);
            $transaksi = Payment::whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month);


        return view('admin.dashboard.index', compact('user', 'studio', 'perangkat', 'denda', 'total', 'transaksi', 'success', 'pending',));
        }
        elseif (Auth::user()->role == 'user'){
            $user = Auth::user();
            if(!empty($user->profile->alamat)){
            Alert::success('Welcome', 'Selamat datang di dashboard user!');
            }
            elseif(empty($user->profile->alamat)){
                Alert::warning('Warning', 'Anda belum mengisi profil, silahkan isi profil anda terlebih dahulu!');
                return redirect()->route('profil.create');
            }
            $now = Carbon::now();
            $studio = SewaStudio::where('user_id', $user->id)->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->sum('grand_total');
            $perangkat = SewaPerangkat::where('user_id', $user->id)->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->sum('grand_total');
            $denda = Denda::where('user_id', $user->id)->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->sum('grand_total');
            $total = Payment::where('user_id', Auth::user()->id)->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->sum('grand_total');
            $payment = Payment::latest()->take(5)->get();
            $transaksi = Payment::where('user_id', Auth::user()->id)->whereYear('created_at',  '=', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month)->count();
        return view('user.dashboard.index', compact('payment', 'total', 'user', 'denda', 'studio', 'perangkat', 'transaksi'));
        }
    }
}
