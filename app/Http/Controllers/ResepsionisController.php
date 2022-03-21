<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resepsionis;

class ResepsionisController extends Controller
{
    public  function index()
    {
        $resepsionis = Resepsionis::all();
        return view('admin.resepsionis.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'foto' => 'required',
            'email' => 'required'
        ]);

        Resepsionis::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'foto' => $request->foto,
            'email' => $request->email,
        ]); 

        return redirect()->route('resepsionis.index')
        ->with('success', 'Resepsionis Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $resepsionis = Resepsionis::findOrfail($id);
        $resepsionis->nama = $request->nama;
        $resepsionis->no_telp = $request->no_telp;
        $resepsionis->foto = $request->foto;
        $resepsionis->email = $request->email;
        $resepsionis->save();

        return redirect()->route('resepsionis.index')
        ->with('success', 'Resepsionis Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Resepsionis::find($id)->delete();
        return redirect()->route('resepsionis.index')
        ->with('success', 'Resepsionis Berhasil Dihapus!');
    }
}
