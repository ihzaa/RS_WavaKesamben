<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = Galeri::all();

        return view('admin.home.galeri.index', compact('data'));
    }

    public function add($id, Request $request)
    {
        Galeri::find($id)->update([
            'link' => $request->link
        ]);

        return response()->json(['ok' => 200]);
    }

    public function remove($id)
    {
        Galeri::find($id)->update([
            'link' => ''
        ]);

        return response()->json(['ok' => 200]);
    }
}
