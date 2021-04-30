<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\GaleriInstagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstagramController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = GaleriInstagram::all();
        return view('admin.home.instagram.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.home.instagram.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:256'
        ]);

        $data = GaleriInstagram::create([
            'image' => 'temp',
            'description' => $request->deskripsi
        ]);

        //UPLOAD FOTO
        $extension = $request->file('foto')->getClientOriginalExtension();
        // File upload location
        $location = 'images/instagram';
        $nameUpload = $data->id . 'instagram.' . $extension;
        // Upload file
        $request->file('foto')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $data->image = $filepath;
        $data->save();

        return redirect(route('admin.home.instagram.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function getEdit($id)
    {
        $data = [];
        $data['item'] = GaleriInstagram::find($id);

        return view('admin.home.instagram.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $data = GaleriInstagram::find($id);
        $data->description = $request->deskripsi;
        if ($request->file('foto') != "") {
            $validated = $request->validate([
                'foto' => 'image|max:256'
            ]);

            //UPLOAD FOTO
            $extension = $request->file('foto')->getClientOriginalExtension();
            // File upload location
            $location = 'images/instagram';
            $nameUpload = $data->id . 'instagram.' . $extension;
            // Upload file
            $request->file('foto')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $data->image = $filepath;
        }


        $data->save();

        return redirect(route('admin.home.instagram.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function delete($id)
    {
        $data = GaleriInstagram::find($id);
        File::delete($data->image);
        $data->delete();

        return redirect(route('admin.home.instagram.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
