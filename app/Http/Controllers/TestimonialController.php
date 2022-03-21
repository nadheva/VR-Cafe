<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public  function index()
    {
        $testimonial = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonial'));
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

        return redirect()->route('testimonial.index')
        ->with('success', 'Testimonial Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrfail($id);
        $testimonial->user_id = $request->testimonial;
        $testimonial->isi = $request->isi;
        $testimonial->save();

        return redirect()->route('testimonial.index')
        ->with('success', 'Testimonial Berhasil Diedit!');
    }

    public function destroy($id)
    {
        Testimonial::find($id)->delete();
        return redirect()->route('testimonial.index')
        ->with('success', 'Testimonial Berhasil Dihapus!');
    }
}
