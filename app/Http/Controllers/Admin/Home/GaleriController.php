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
        $data['item'] = Galeri::orderBy('id', 'desc')->paginate(10);

        return view('admin.home.galeri.index', compact('data'));
    }

    public function add(Request $request)
    {

        $detail = $request->link;
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $iframe = $dom->getelementsbytagname('iframe');
        foreach ($iframe as $i) {
            $i->removeattribute('height');
            $i->removeattribute('width');
            $i->setAttribute('class', 'galeri_yt');
        }


        Galeri::create([
            'link' => $dom->savehtml()
        ]);

        // return response()->json(['ok' => 200]);
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function remove($id)
    {
        // Galeri::find($id)->update([
        //     'link' => ''
        // ]);
        Galeri::find($id)->delete();

        return response()->json(['ok' => 200]);
    }
}
