<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    public  function index()
    {
        $wishlist = Wishlist::all();
        return view('admin.wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->id;

        Wishlist::create([
            'user_id' => $user,
            'studio_id' => $request->studio_id,
            'perangkat_id' => $request->perangkat_id
        ]);
        Alert::success('Success', 'Wishlist berhasil ditambahkan!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $id1 = decrypt($id);
        Wishlist::findOrfail($id1)->delete();
        Alert::warning('Warning', 'Wishlist berhasil dihapus!');
        return redirect()->back();
    }
}
