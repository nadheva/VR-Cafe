<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{
    public  function index()
    {
        // $testimonial = Testimonial::all();
        // return view('user.testimonial.index', compact('testimonial'));
        return abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'isi' => 'required'
        ]);

        Testimonial::create([
            'user_id' => $request->user_id,
            'isi' => $request->isi
        ]);
        Alert::success('Success', 'Testimonial berhasil ditambahkan');
        return redirect()->route('testimonial.index');
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrfail($id);
        $testimonial->user_id = $request->testimonial;
        $testimonial->isi = $request->isi;
        $testimonial->save();
        Alert::info('Info', 'Testimonial berhasil diedit!');
        return redirect()->route('testimonial.index');
    }

    public function destroy($id)
    {
        Testimonial::find($id)->delete();
        Alert::warning('Warning', 'Testimonial berhasil dihapus!');
        return redirect()->route('testimonial.index');
    }
}
