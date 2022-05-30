<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resepsionis;
use RealRashid\SweetAlert\Facades\Alert;

class ResepsionisController extends Controller
{
    public  function index()
    {
        $resepsionis = Resepsionis::all();
        return view('admin.resepsionis.index', compact('resepsionis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'foto' => 'required',
            'email' => 'required'
        ]);
        if (isset($request->foto)) {
            $extention = $request->foto->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/resepsionis/". $file_name;
            $request->foto->storeAs('public/resepsionis', $file_name);
        } else {
            $file_name = null;
        }
        Resepsionis::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'foto' => $txt,
            'email' => $request->email,
        ]);
        Alert::success('Success', 'Resepsionis berhasil ditambahkan!');
        return redirect()->route('resepsionis.index');
    }

    public function update(Request $request, $id)
    {
        $resepsionis = Resepsionis::findOrfail($id);
        $resepsionis->nama = $request->nama;
        $resepsionis->no_telp = $request->no_telp;
        $resepsionis->email = $request->email;
        if (isset($request->foto)) {
            $extention = $request->foto->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/resepsionis/". $file_name;
            $request->foto->storeAs('public/resepsionis', $file_name);
            $resepsionis->foto = $txt;
        } else {
            $file_name = null;
        }
        $resepsionis->save();
        Alert::info('Info', 'Resepsionis berhasil diedit!');
        return redirect()->route('resepsionis.index');
    }

    public function destroy($id)
    {
        Resepsionis::find($id)->delete();
        Alert::warning('Warning', 'Resepsionis berhasil dihapus!');
        return redirect()->route('resepsionis.index');
    }
}
