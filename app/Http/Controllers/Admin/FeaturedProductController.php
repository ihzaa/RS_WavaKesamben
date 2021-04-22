<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function index()
    {
        $data = array();
        $data['list'] = FeaturedProduct::all();
        return view('admin.featuredProduct.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.featuredProduct.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        FeaturedProduct::create([
            'title' => $request->judul,
            'description' => $request->deskripsi
        ]);

        return redirect(route('admin.featuredproduct.index'))->with('icon', 'success')->with('title', 'Maaf!')->with('text', 'Username atau Password Salah!');
    }
}
