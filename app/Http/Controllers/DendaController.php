<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denda;

class DendaController extends Controller
{
    public  function index()
    {
        $denda = Denda::all();
        return view('admin.denda.index', compact('denda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'grand_total' => 'required',
        ]);

        Denda::create([
            'sewa_ruang_id' => $request->sewa_ruang_id,
            'sewa_perangkat_id' =>  $request->sewa_perangkat_id,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'snap_token' => $request->snap_token,
            'grand-total' => $request->grand_total
        ]); 

        return redirect()->route('denda.index')
        ->with('success', 'Denda Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $denda = Denda::findOrfail($id);
        $denda->sewa_ruang_id = $request->sewa_ruang_id;
        $denda->sewa_perangkat_id = $request->sewa_perangkat_id;
        $denda->user_id = $request->user_id;
        $denda->status = $request->status;
        $denda->snap_token = $request->snap_token;
        $denda->grand_total = $request->grand_total;
        $denda->save();

        return redirect()->route('denda.index')
        ->with('success', 'Denda Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Denda::find($id)->delete();
        return redirect()->route('denda.index')
        ->with('success', 'Denda Berhasil Dihapus!');
    }
}
