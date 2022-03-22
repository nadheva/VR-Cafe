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
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/ruang/". $file_name;
            $request->gambar->storeAs('public/ruang', $file_name);
        } else {
            $file_name = null;
        }
        Ruang::create([
            'nama' => $request->nama,
            'gambar' => $txt,
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
        $ruang->resepsionis_id = $request->resepsionis_id;
        $ruang->harga = $request->harga;
        $ruang->deskripsi = $request->deskripsi;
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/ruang/". $file_name;
            $request->gambar->storeAs('public/ruang', $file_name);
            $ruang->gambar = $txt;
        } else {
            $file_name = null;
        }
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
