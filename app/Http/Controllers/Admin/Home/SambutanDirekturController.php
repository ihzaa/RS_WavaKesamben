<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\SambutanDirektur;
use Illuminate\Http\Request;

class SambutanDirekturController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = SambutanDirektur::first();
        return view('admin.home.sambutanDirektur.index', compact('data'));
    }

    public function edit(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:256'
        ]);

        $data = SambutanDirektur::find(1);
        $data->name = $request->nama;
        $data->description = $request->deskripsi;
        if ($request->file('foto') != "") {
            $validated = $request->validate([
                'foto' => 'image|max:256'
            ]);
            $extension = $request->file('foto')->getClientOriginalExtension();
            // File upload location
            $location = 'images/direktur';
            $nameUpload =  'Direktur.' . $extension;
            // Upload file
            $request->file('foto')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $data->image = $filepath;
        }
        $data->save();
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }
}
