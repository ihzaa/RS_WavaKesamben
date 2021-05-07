<?php

namespace App\Http\Controllers\Admin\HealthyPromotion;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = Testimonial::orderBy('id', 'desc')->get();

        return view('admin.healthyPromotion.testimonial.index', compact('data'));
    }

    public function postAdd(Request $request)
    {
        Testimonial::create([
            'name' => $request->nama,
            'description' => $request->deskripsi
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function postEdit($id, Request $request)
    {
        Testimonial::find($id)->update([
            'name' => $request->nama,
            'description' => $request->deskripsi
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Mengubah!');
    }

    public function delete($id)
    {
        Testimonial::find($id)->delete();
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
