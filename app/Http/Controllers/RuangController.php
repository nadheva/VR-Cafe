<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\Resepsionis;
use Illuminate\Support\Str;

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
            'ukuran' => 'required',
            'monitor' => 'required',
            'perangkat_vr' => 'required',
            'pc_desktop' => 'required',
            'deskripsi' => 'required'
        ]);
        $image = array();
        if($file = $request->file('gambar_detail')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = $file->extension();
                $image_full_name =  $image_name . '.' . $ext;
                $upload_path = "storage/ruang/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/ruang/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                // $perangkat->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }

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
            $txt2 = "storage/ruang/banner/". $file_name;
            $request->banner->storeAs('public/ruang/banner', $file_name);
        } else {
            $file_name = null;
        }
        Ruang::create([
            'kode_ruang' => $request->kode_ruang,
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama, '-'),
            'gambar' => $txt,
            'banner' => $txt2,
            'gambar_detail' => json_encode($image),
            'resepsionis_id' => $request->resepsionis_id,
            'harga' => $request->harga,
            'ukuran' => $request->ukuran,
            'monitor' => $request->monitor,
            'perangkat_vr' => $request->perangkat_vr,
            'pc_desktop' => $request->pc_desktop,
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
        $ruang->slug = Str::slug($request->nama, '-');
        $ruang->resepsionis_id = $request->resepsionis_id;
        $ruang->harga = $request->harga;
        $ruang->deskripsi = $request->deskripsi;
        $ruang->ukuran = $request->ukuran;
        $ruang->monitor = $request->monitor;
        $ruang->pc_desktop = $request->pc_desktop;
        $ruang->perangkat_vr = $request->perangkat_vr;
        $image = array();
        if($file = $request->file('gambar_detail')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = $file->extension();
                $image_full_name =  $image_name . '.' . $ext;
                $upload_path = "storage/ruang/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/ruang/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                $ruang->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }
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
            $txt2 = "storage/ruang/banner/". $file_name;
            $request->banner->storeAs('public/ruang/banner', $file_name);
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
