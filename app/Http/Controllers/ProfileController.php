<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public  function index()
    {
        $user = Auth::user();
        $profil = Profile::where('user_id', $user->id)->first();
        return view('user.profil.index', compact('profil'));
    }

    public function create()
    {
        $email = Auth::user()->email;
        return view('user.profil.create', compact('email'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required',
        //     'nama_depan' => 'required',
        //     'nama_belakang' => 'required',
        //     'nik' => 'required',
        //     'no_telp' => 'required',
        //     'foto' => 'required',
        //     'alamat' => 'required',
        //     'kota' => 'required',
        //     'provinsi' => 'required',
        //     'kode_pos' => 'required'
        // ]);

        if (isset($request->foto)) {
            $extention = $request->foto->extension();
            $file_name = time() . '.' . $extention;
            $txt = "storage/profile/". $file_name;
            $request->foto->storeAs('public/profile', $file_name);
        } else {
            $file_name = null;
        }
        $user = Auth::user()->id;
        Profile::create([
            'user_id' => $user,
            'nama_depan' => $request->nama_depan,
            'nama_belakang'  => $request->nama_belakang,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'foto' => $txt,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos
        ]);

        return redirect()->route('profil.index')
        ->with('success', 'Profil Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $profil = Profile::find($id);
        $email = Auth::user()->email;
        return view('user.profil.edit', compact('profil', 'email'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user()->id;
        $profile = Profile::findOrfail($id);
        $profile->user_id = $user;
        $profile->nama_depan = $request->nama_depan;
        $profile->nama_belakang = $request->nama_belakang;
        $profile->nik = $request->nik;
        $profile->no_telp = $request->no_telp;
        $profile->facebook = $request->facebook;
        $profile->instagram = $request->intagram;
        $profile->alamat = $request->alamat;
        $profile->kota = $request->kota;
        $profile->provinsi = $request->provinsi;
        $profile->kode_pos = $request->kode_pos;
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

        return redirect()->route('profil.index')
        ->with('success', 'Profile Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Profile::find($id)->delete();
        return redirect()->route('profil.index')
        ->with('success', 'Profil Berhasil Dihapus!');
    }
}
