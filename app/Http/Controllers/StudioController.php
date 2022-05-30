<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Models\Resepsionis;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class StudioController extends Controller
{
    public  function index()
    {
        $studio = Studio::all();
        $resepsionis = Resepsionis::all();
        return view('admin.studio.index', compact('studio', 'resepsionis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_studio' => 'required',
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
                $upload_path = "storage/studio/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/studio/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                // $perangkat->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }

        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/studio/". $file_name;
            $request->gambar->storeAs('public/studio', $file_name);
        } else {
            $file_name = null;
        }
        if (isset($request->banner)) {
            $extention = $request->banner->extension();
            $file_name = time() . '.' . $extention;
            $txt2 = "storage/studio/banner/". $file_name;
            $request->banner->storeAs('public/studio/banner', $file_name);
        } else {
            $file_name = null;
        }
        Studio::create([
            'kode_studio' => $request->kode_studio,
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama, '-'),
            'gambar' => $txt,
            'banner' => $txt2,
            'gambar_detail' => json_encode($image),
            'resepsionis_id' => $request->resepsionis_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'ukuran' => $request->ukuran,
            'monitor' => $request->monitor,
            'perangkat_vr' => $request->perangkat_vr,
            'pc_desktop' => $request->pc_desktop,
            'deskripsi' => $request->deskripsi
        ]);
        Alert::success('Success', 'Studio berhasil ditambahkan!');
        return redirect()->route('studio.index');
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::findOrfail($id);
        $studio->kode_studio = $request->kode_studio;
        $studio->nama = $request->nama;
        $studio->slug = Str::slug($request->nama, '-');
        $studio->resepsionis_id = $request->resepsionis_id;
        $studio->harga = $request->harga;
        $studio->deskripsi = $request->deskripsi;
        $studio->ukuran = $request->ukuran;
        $studio->monitor = $request->monitor;
        $studio->pc_desktop = $request->pc_desktop;
        $studio->perangkat_vr = $request->perangkat_vr;
        $studio->jumlah = $request->jumlah;
        $image = array();
        if($file = $request->file('gambar_detail')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = $file->extension();
                $image_full_name =  $image_name . '.' . $ext;
                $upload_path = "storage/studio/gambar_detail/".$image_full_name;
                // $image_url = $uploade_path;
                $file->storeAs('public/studio/gambar_detail/', $image_full_name);
                $image[] = $upload_path;
                $studio->gambar_detail = json_encode($image);
            }
        } else {
            $image_full_name = null;
        }
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/studio/". $file_name;
            $request->gambar->storeAs('public/studio', $file_name);
            $studio->gambar = $txt;
        } else {
            $file_name = null;
        }
        if (isset($request->banner)) {
            $extention = $request->banner->extension();
            $file_name = time() . '.' . $extention;
            $txt2 = "storage/studio/banner/". $file_name;
            $request->banner->storeAs('public/studio/banner', $file_name);
            $studio->banner = $txt2;
        } else {
            $file_name = null;
        }
        $studio->save();
        Alert::info('Info', 'Studio berhasil diedit!');
        return redirect()->route('studio.index');
    }

    public function destroy($id)
    {
        Studio::find($id)->delete();
        Alert::warning('Warning', 'Studio berhasil dihapus!');
        return redirect()->route('studio.index');
    }
}
