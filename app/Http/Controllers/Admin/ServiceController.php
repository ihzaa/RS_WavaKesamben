<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = Service::all();
        return view('admin.service.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.service.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $input = Service::create([
            'title' => $request->judul,
            'description' => 'temp'
        ]);

        $detail = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $input->id . '-' . $k . '-' . time() . '.png';
            $path = '/images/service/' . $image_name;
            ServiceImages::create([
                'path' => $path,
                'service_id' => $input->id
            ]);
            File::put('images/service/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', asset($path));
        }
        $detail = $dom->savehtml();
        $input->description = $detail;
        $input->save();

        return redirect(route('admin.services.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function getEdit($id)
    {
        $data = [];
        $data['item'] = Service::find($id);

        return view('admin.service.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $product = Service::find($id);
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
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $id . '-' . $k . '-' . time() . '.png';
                $path = '/images/service/' . $image_name;
                ServiceImages::create([
                    'path' => $path,
                    'service_id' => $id
                ]);
                File::put('images/service/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', asset($path));
            }
        }
        $detail = $dom->savehtml();
        $product->description = $detail;
        $product->save();

        return redirect(route('admin.services.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Mengedit!');
    }

    public function delete($id)
    {
        $foto = ServiceImages::where('service_id', $id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        Service::find($id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
