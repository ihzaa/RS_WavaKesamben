<?php

namespace App\Http\Controllers\Admin\HealthyPromotion;

use App\Http\Controllers\Controller;
use App\Models\agenda_activity_image;
use App\Models\AgendaActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaActivityController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = AgendaActivity::all();

        return view('admin.healthyPromotion.agendaActivity.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.healthyPromotion.agendaActivity.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:256|required',
            'judul' => 'required'
        ]);

        $input = AgendaActivity::create([
            'title' => $request->judul,
            'image' => 'temp',
            'description' => ''
        ]);

        //UPLOAD FOTO
        $extension = $request->file('foto')->getClientOriginalExtension();
        // File upload location
        $location = 'images/healthy_promotion/agenda_activity/main';
        $nameUpload = $input->id . 'agenda_activity.' . $extension;
        // Upload file
        $request->file('foto')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $input->image = $filepath;

        if ($request->deskripsi != "") {
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
                $path = '/images/healthy_promotion/agenda_activity/images/' . $image_name;
                agenda_activity_image::create([
                    'path' => $path,
                    'agenda_activity_id' => $input->id
                ]);
                File::put('images/healthy_promotion/agenda_activity/images/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', asset($path));
            }
            $detail = $dom->savehtml();
            $input->description = $detail;
        }

        $input->save();
        return redirect(route('admin.healthyPromotion.agendaActivity.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function getEdit($id)
    {
        $data = [];
        $data['item'] = AgendaActivity::find($id);

        return view('admin.healthyPromotion.agendaActivity.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:256',
            'judul' => 'required'
        ]);

        $input = AgendaActivity::find($id);
        $input->title = $request->judul;
        if ($request->file('foto') != "") {
            //UPLOAD FOTO
            $extension = $request->file('foto')->getClientOriginalExtension();
            // File upload location
            $location = 'images/healthy_promotion/agenda_activity/main';
            $nameUpload = $input->id . 'agenda_activity.' . $extension;
            // Upload file
            $request->file('foto')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $input->image = $filepath;
        }

        if ($request->deskripsi != "") {
            $detail = $request->deskripsi;
            $dom = new \domdocument();
            @$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getelementsbytagname('img');

            foreach ($images as $k => $img) {
                $data = $img->getattribute('src');
                // dd($data[0],strpos($data, 'http'));
                if ($data[0] == 'd') {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = $input->id . '-' . $k . '-' . time() . '.png';
                    $path = '/images/healthy_promotion/agenda_activity/images/' . $image_name;
                    agenda_activity_image::create([
                        'path' => $path,
                        'agenda_activity_id' => $input->id
                    ]);
                    File::put('images/healthy_promotion/agenda_activity/images/' . $image_name, $data);
                    $img->removeattribute('src');
                    $img->setattribute('src', asset($path));
                }
            }
            $detail = $dom->savehtml();
            $input->description = $detail;
        } else {
            $input->description = null;
            $foto = agenda_activity_image::where('agenda_activity_id', $input->id)->get();
            foreach ($foto as $f) {
                File::delete(substr($f->path, 1));
            }
            agenda_activity_image::where('agenda_activity_id', $input->id)->delete();
        }

        $input->save();

        return redirect(route('admin.healthyPromotion.agendaActivity.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function delete($id)
    {
        $input = AgendaActivity::find($id);
        File::delete($input->image);
        $foto = agenda_activity_image::where('agenda_activity_id', $input->id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        $input->delete();
        return redirect(route('admin.healthyPromotion.agendaActivity.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
