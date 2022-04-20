<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $total = $cart->sum('harga');
        return view('user.cart.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('perangkat_id', $request->perangkat_id)
                ->where('user_id', Auth::user()->id);
        if($cart->count()) {
            $cart->increment('jumlah');
            $cart = $cart->first();
            $harga = $request->harga * $cart->jumlah;
            $cart->update([
                'harga' => $harga
            ]);
        } else {
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'perangkat_id' => $request->perangkat_id,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga
            ]);
        }
        return redirect()->back()
        ->with('success', 'Perangkat telah ditambahkan ke keranjang!');
    }

    public function destroy(Request $request)
    {
        Cart::with('perangkat')
              ->whereId($request->cart_id)
              ->delete();
    }

    public function destroy_all()
    {
        Cart::with('perangkat')
            ->where('user_id', Auth::user()->id)
            ->delete();
    }


}
