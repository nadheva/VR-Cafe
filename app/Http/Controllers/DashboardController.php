<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        return view('dashboard');
    }
}
