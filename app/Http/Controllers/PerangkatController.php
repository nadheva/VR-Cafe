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
    public  function create()
    {
        return view('admin.perangkat.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_perangkat' => 'required',
            'nama' => 'required',
            'gambar' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required'
        ]);

        $image = array();
        if($file = $request->file('gambar_detail')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = $file->extension();
                $image_full_name =  $image_name . '.' . $ext;
                $upload_path = "storage/perangkat/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/perangkat/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                // $perangkat->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }

        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/perangkat/". $file_name;
            $request->gambar->storeAs('public/perangkat', $file_name);
        } else {
            $file_name = null;
        }

        Perangkat::create([
            'kode_perangkat' => $request->kode_perangkat,
            'nama' => $request->nama,
            'gambar' => $txt,
            'gambar_detail' => json_encode($image),
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);
        // notify()->success('Perangkat berhasil ditambahkan');

        return redirect()->route('perangkat.index')
        ->with('success', 'Perangkat Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $perangkat = Perangkat::findOrfail($id);
        $perangkat->kode_perangkat = $request->kode_perangkat;
        $perangkat->nama = $request->nama;
        $perangkat->stok = $request->stok;
        $perangkat->harga = $request->harga;
        $perangkat->deskripsi = $request->deskripsi;
        $image = array();
        if($file = $request->file('gambar_detail')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = $file->extension();
                $image_full_name =  $image_name . '.' . $ext;
                $upload_path = "storage/perangkat/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/perangkat/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                $perangkat->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }
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
