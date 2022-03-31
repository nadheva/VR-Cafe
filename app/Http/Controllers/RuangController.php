<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\Resepsionis;

class RuangController extends Controller
{
    public  function index()
    {
        $ruang = Ruang::all();
        $resepsionis = Resepsionis::all();
        return view('admin.ruang.index', compact('ruang', 'resepsionis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruang' => 'required',
            'nama' => 'required',
            'gambar' => 'required',
            'resepsionis_id' => 'required',
            'banner' => 'required',
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
        if (isset($request->banner)) {
            $extention = $request->banner->extension();
            $file_name = time() . '.' . $extention;
            $txt2 = "storage/ruangbanner/". $file_name;
            $request->banner->storeAs('public/ruangbanner', $file_name);
        } else {
            $file_name = null;
        }
        Ruang::create([
            'kode_ruang' => $request->kode_ruang,
            'nama' => $request->nama,
            'gambar' => $txt,
            'banner' => $txt2,
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
        $ruang->kode_ruang = $request->kode_ruang;
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
        if (isset($request->banner)) {
            $extention = $request->banner->extension();
            $file_name = time() . '.' . $extention;
            $txt2 = "storage/ruangbanner/". $file_name;
            $request->banner->storeAs('public/ruangbanner', $file_name);
            $ruang->banner = $txt2;
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
