<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public  function index()
    {
        $profile = Profile::all();
        return view('admin.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'no_telp' => 'required',
            'foto' => 'required',
            'alamat' => 'required'
        ]);

        if (isset($request->foto)) {
            $extention = $request->foto->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/profile/". $file_name;
            $request->foto->storeAs('public/profile', $file_name);
        } else {
            $file_name = null;
        }
        Profile::create([
            'user_id' => $request->user_id,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'foto' => $txt,
            'alamat' => $request->alamat,
        ]); 

        return redirect()->route('profile.index')
        ->with('success', 'Profile Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrfail($id);
        $profile->user_id = $request->user_id;
        $profile->nama_lengkap = $request->nama_lengkap;
        $profile->nik = $request->nik;
        $profile->no_telp = $request->no_telp;
        $profile->alamat = $request->alamat;
        if (isset($request->foto)) {
            $extention = $request->foto->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/profile/". $file_name;
            $request->foto->storeAs('public/profile', $file_name);
            $profile->foto = $txt;
        } else {
            $file_name = null;
        }
        $profile->save();

        return redirect()->route('profile.index')
        ->with('success', 'Profile Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Profile::find($id)->delete();
        return redirect()->route('profile.index')
        ->with('success', 'Profile Berhasil Dihapus!');
    }
}
