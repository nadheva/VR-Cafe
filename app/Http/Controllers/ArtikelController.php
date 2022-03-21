<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;

class ArtikelController extends Controller
{
    public  function index()
    {
        $artikel = Artikel::all();
        return view('admin.artikel.index', compact('artikel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required'
        ]);

        Artikel::create([
            'isi' => $request->isi
        ]); 

        return redirect()->route('artikel.index')
        ->with('success', 'Artikel Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrfail($id);
        $artikel->isi = $request->isi;
        $artikel->save();

        return redirect()->route('artikel.index')
        ->with('success', 'Artikel Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Artikel::find($id)->delete();
        return redirect()->route('artikel.index')
        ->with('success', 'Artikel Berhasil Dihapus!');
    }
}
