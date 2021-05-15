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


        Galeri::find($id)->update([
            'link' => $dom->savehtml()
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
