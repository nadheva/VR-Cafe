<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;

class RuangController extends Controller
{
    public  function index()
    {
        $ruang = Ruang::all();
        return view('admin.ruang.index', compact('ruang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'required',
            'resepsionis_id' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required'
        ]);

        Ruang::create([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'resepsionis_id' => $request->resepsionis_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]); 

        return redirect()->route('ruang.index')
        ->with('success', 'Ruang Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $ruang = Ruang::findOrfail($id);
        $ruang->nama = $request->nama;
        $ruang->gambar = $request->gambar;
        $ruang->resepsionis_id = $request->resepsionis_id;
        $ruang->harga = $request->harga;
        $ruang->deskripsi = $request->deskripsi;
        $ruang->save();

        return redirect()->route('ruang.index')
        ->with('success', 'Ruang Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Ruang::find($id)->delete();
        return redirect()->route('ruang.index')
        ->with('success', 'Ruang Berhasil Dihapus!');
    }
}
