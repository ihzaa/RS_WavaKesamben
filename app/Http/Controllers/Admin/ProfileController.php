<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data = array();
        $data['list'] = Profile::all();
        return view('admin.profile.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.profile.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Profile::create([
            'title' => $request->judul,
            'description' => $request->deskripsi,
        ]);

        return redirect(route('admin.profile.index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Artikel baru telah ditambahkan pada menu profil');
    }

    public function getEdit($id)
    {
        $data['profile'] = Profile::find($id);

        return view('admin.profile.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Profile::find($id)->update([
            'title' => $request->judul,
            'description' => $request->deskripsi,
        ]);

        return redirect(route('admin.profile.index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil merubah artikel.');
    }

    public function delete($id)
    {
        Profile::find($id)->delete();

        return redirect(route('admin.profile.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus artikel!');
    }
}
