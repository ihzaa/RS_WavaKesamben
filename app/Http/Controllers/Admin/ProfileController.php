<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $input = Profile::create([
            'title' => $request->judul,
            'description' => 'temp',
        ]);

        $detail = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //UPLOAD GAMBAR DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $input->id . '-' . $k . '-' . time() . '.png';
            $path = '/images/profile/' . $image_name;
            ProfileImage::create([
                'path' => $path,
                'profile_id' => $input->id,
            ]);
            File::put('images/profile/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $path);
        }
        $detail = $dom->savehtml();
        $input->description = $detail;
        $input->save();

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

        $product = Profile::find($id);
        $product->title = $request->judul;

        $detail = $request->deskripsi;
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //UPLOAD GAMBAR DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            if ($data[0] != 'h') {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $id . '-' . $k . '-' . time() . '.png';
                $path = '/images/profile/' . $image_name;
                ProfileImage::create([
                    'path' => $path,
                    'profile_id' => $id,
                ]);
                File::put('images/profile/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', $path);
            }
        }
        $detail = $dom->savehtml();
        $product->description = $detail;
        $product->save();

        return redirect(route('admin.profile.index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil merubah artikel.');
    }

    public function delete($id)
    {
        $product = Profile::find($id);
        $foto = ProfileImage::where('profile_id', $id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        $product->delete();
        // Session::flash('icon', 'success');
        // Session::flash('title', 'Berhasil');
        // Session::flash('text', 'Berhasil Menghapus!');
        // return response()->json(['OK' => 200]);

        return redirect(route('admin.profile.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus artikel!');
    }
}
