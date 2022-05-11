<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Exists;

class DashboardController extends Controller
{
    // public function __construct(Request $request){

    //     $userid = Auth::user();
    //     if(is_null(Profile::where('user_id', $userid)->first())) {
    //         $email = Auth::user()->email;
    //         return view('user.profil.create');
    //     } else {
    //     return view('dashboard');
    //     }
    // }

    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
        return view('dashboard');
        }
        elseif (Auth::user()->role == 'user'){
            $user = Auth::user();
            $now = Carbon::now();
            $total = Payment::whereYear('created_at', $now->year())->whereMonth('created_at', $now->month())->sum('grand_total');
            $payment = Payment::latest()->take(5)->get();
        return view('user.dashboard.index', compact('payment', 'total', 'user'));
        }
    }
}
