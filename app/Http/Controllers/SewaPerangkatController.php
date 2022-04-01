<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SewaPerangkat;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;

class SewaPerangkatController extends Controller
{
    public function index()
    {
        $perangkat = Perangkat::all();
        return view('user.sewa-perangakat.index', compact('perangkat'));
    }

    public function create($id)
    {
        $perangkat = Perangkat::where('id', $id)->first();
        return view('user.sewa-perangkat.sewa', compact('perangkat'));
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $perangkat = Perangkat::where('id', $id)->first();
        $this->validate($request, [
            'perangkat_id' => 'required',
            'user_id' => 'required',
            'invoice' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' =>  'required',
            'keperluan' => 'required',
            'proses' => 'required',
            'status' => 'required',
            'grand_total' => 'required'
        ]);

        $sewa_perangkat = SewaPerangkat::create([
            'perangkat_id' => $perangkat,
            'user_id' => $user,
            'invoice' => $request->invoice,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' =>  $request->tanggal_berakhir,
            'keperluan' => $request->keperluan,
            'proses' => $request->proses,
            'status' => $request->status,
            'snap_token' => $request->snap_token,
            'grand_total' => $request->grand_total
        ]);

        $sewa_perangkat->perangkat->where('id', $sewa_perangkat->perangkat_id)
                                        ->update([
                                            'stok' => ($sewa_perangkat->perangkat->stok - 1),
                                        ]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }


}
