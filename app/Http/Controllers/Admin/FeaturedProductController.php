<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use App\Models\FeaturedProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

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

        $input = FeaturedProduct::create([
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
            $path = '/images/featured_product/' . $image_name;
            FeaturedProductImage::create([
                'path' => $path,
                'featured_product_id' => $input->id
            ]);
            File::put('images/featured_product/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $path);
        }
        $detail = $dom->savehtml();
        $input->description = $detail;
        $input->save();

        return redirect(route('admin.featuredproduct.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function getEdit($id)
    {
        $data = array();
        $data['item'] = FeaturedProduct::find($id);

        return view('admin.featuredProduct.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $product = FeaturedProduct::find($id);
        $product->title = $request->judul;

        $detail = $request->deskripsi;
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //UPLOAD GAMBAR DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            if ($data[0] != '/') {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $id . '-' . $k . '-' . time() . '.png';
                $path = '/images/featured_product/' . $image_name;
                FeaturedProductImage::create([
                    'path' => $path,
                    'featured_product_id' => $id
                ]);
                File::put('images/featured_product/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', $path);
            }
        }
        $detail = $dom->savehtml();
        $product->description = $detail;
        $product->save();

        return redirect(route('admin.featuredproduct.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Mengedit!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $product = FeaturedProduct::find($id);
        $foto = FeaturedProductImage::where('featured_product_id', $id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        $product->delete();
        Session::flash('icon', 'success');
        Session::flash('title', 'Berhasil');
        Session::flash('text', 'Berhasil Menghapus!');
        return response()->json(['OK' => 200]);
    }
}
