<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perangkat;

class PerangkatController extends Controller
{
    public  function index()
    {
        $perangkat = Perangkat::all();
        return view('admin.perangkat.index', compact('perangkat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required'
        ]);

        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/perangkat/". $file_name;
            $request->gambar->storeAs('public/perangkat', $file_name);
        } else {
            $file_name = null;
        }

        Perangkat::create([
            'nama' => $request->nama,
            'gambar' => $txt,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]); 

        return redirect()->route('perangkat.index')
        ->with('success', 'Perangkat Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrfail($id);
        $perangkat->nama = $request->nama;
        $perangkat->stok = $request->stok;
        $perangkat->harga = $request->harga;
        $perangkat->deskripsi = $request->deskripsi;
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/perangkat/". $file_name;
            $request->gambar->storeAs('public/perangkat', $file_name);
            $perangkat->gambar = $txt;
        } else {
            $file_name = null;
        }
        $perangkat->save();

        return redirect()->route('perangkat.index')
        ->with('success', 'Perangkat Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Perangkat::find($id)->delete();
        return redirect()->route('perangkat.index')
        ->with('success', 'Perangkat Berhasil Dihapus!');
    }
}
