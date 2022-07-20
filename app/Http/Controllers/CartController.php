<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        foreach($cart as $c) {
            if($c->stok < $request->jumlah)
            {
                Alert::info('Info', 'Stok perangkat tidak tersedia!');
                return redirect()->back();
            }
        }
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
                'harga' => $request->harga * $request->jumlah
            ]);
        }
        Alert::success('Success', 'Perangkat berhasil ditambahkan ke keranjang!');
        return redirect()->back();

    }

    public function destroy($id)
    {
        Cart::find($id)->delete();
        Alert::warning('Warning', 'Perangkat berhasil dihapus dari keranjang!');
        return redirect()->back();
    }

    // public function destroy(Request $request)
    // {
    //     Cart::with('perangkat')
    //           ->whereId($request->cart_id)
    //           ->delete();
    //     return redirect()->back()
    //     ->with('warning', 'Berhasil dihapus dari keranjang');
    // }

    public function destroy_all()
    {
        Cart::with('perangkat')
            ->where('user_id', Auth::user()->id)
            ->delete();
    }

    public function getCart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->count();
        return $cart;
    }


}
