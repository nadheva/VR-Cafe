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
            'judul' => 'required',
            'isi' => 'required'
        ]);
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/artikel/". $file_name;
            $request->gambar->storeAs('public/artikel', $file_name);
        } else {
            $file_name = null;
        }

        Artikel::create([
            'judul' => $request->judul,
            'gambar' => $txt,
            'isi' => $request->isi
        ]);

        return redirect()->route('artikel.index')
        ->with('success', 'Artikel Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrfail($id);
        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/artikel/". $file_name;
            $request->gambar->storeAs('public/artikel', $file_name);
            $artikel->gambar = $txt;
        } else {
            $file_name = null;
        }
        $artikel->save();

        return redirect()->route('artikel.index')
        ->with('info', 'Artikel Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Artikel::find($id)->delete();
        return redirect()->route('artikel.index')
        ->with('warning', 'Artikel Berhasil Dihapus!');
    }
}
