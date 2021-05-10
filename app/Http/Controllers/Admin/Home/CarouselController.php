<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CarouselController extends Controller
{
    public function index()
    {
        $data = array();
        $data['item'] = Carousel::all();
        return view('admin.home.banner.carousel.index', compact('data'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:512'
        ]);

        $carousel = Carousel::create([
            'title' => $request->judul,
            'image' => 'temp',
            'description' => $request->deskripsi
        ]);

        //UPLOAD FOTO
        $extension = $request->file('foto')->getClientOriginalExtension();
        // File upload location
        $location = 'images/carousel';
        $nameUpload = $carousel->id . 'carousel.' . $extension;
        // Upload file
        $request->file('foto')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $carousel->image = $filepath;
        $carousel->save();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function edit($id, Request $request)
    {
        $carousel = Carousel::find($id);
        $carousel->title = $request->judul;
        $carousel->description = $request->deskripsi;
        if ($request->file('foto') != "") {
            $validated = $request->validate([
                'foto' => 'image|max:512'
            ]);
            $extension = $request->file('foto')->getClientOriginalExtension();
            // File upload location
            $location = 'images/carousel';
            $nameUpload = $carousel->id . 'carousel.' . $extension;
            // Upload file
            $request->file('foto')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $carousel->image = $filepath;
        }
        $carousel->save();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function delete(Request $request)
    {
        $carousel = Carousel::find($request->id);
        File::delete($carousel->image);
        $carousel->delete();

        Session::flash('icon', 'success');
        Session::flash('title', 'Berhasil');
        Session::flash('text', 'Berhasil Menghapus!');
        return response()->json(['OK' => 200]);
    }
}
