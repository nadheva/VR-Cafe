<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
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
        $request->validate([
            'user_id' => 'required',
        ]);

        Wishlist::create([
            'user_id' => $request->user_id,
            'studio_id' => $request->studio_id,
            'perangkat_id' => $request->perangkat_id
        ]);
        Alert::success('Success', 'Wishlist berhasil ditambahkan!');
        return redirect()->route('wishlist.index');
    }

    public function update(Request $request, $id)
    {
        $wishlist = Wishlist::findOrfail($id);
        $wishlist->user_id = $request->testimonial;
        $wishlist->studio_id = $request->studio_id;
        $wishlist->perangkat_id = $request->perangkat_id;
        $wishlist->save();
        Alert::info('info', 'Wishlist berhasil diedit!');
        return redirect()->route('wishlist.index');
    }

    public function destroy($id)
    {
        Wishlist::find($id)->delete();
        Alert::warning('Warning', 'Wishlist berhasil dihapus!');
        return redirect()->route('wishlist.index');
    }
}
