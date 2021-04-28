<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    public function index()
    {
        $data = array();
        $data['list'] = Department::all();
        return view('admin.department.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.department.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'quotes' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'deskripsi' => 'required',
        ]);
        dd($request->hasFile('logo'));

        $input = Department::create([
            'title' => $request->nama,
            'quotes' => $request->quotes,
            'image' => 'temp',
            'description' => 'temp',
        ]);

        //UPLOAD LOGO
        $extension = $request->file('logo')->getClientOriginalExtension();
        $location = 'images/department/';
        $nameUpload = $input->id . '-' . $input->title . '.' . $extension;
        // $request->file('logo')->move('assets/' . $location, $nameUpload);
        File::put($location . $nameUpload, $request->file('logo'));
        // dd($request->file('logo'));
        $filepath = $location . "/" . $nameUpload;
        $input->image = $filepath;

        $detail = $request->deskripsi;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        //UPLOAD GAMBAR KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $input->id . '-' . $k . '-' . time() . '.png';
            $path = '/images/department/' . $image_name;
            DepartmentImage::create([
                'path' => $path,
                'department_id' => $input->id,
            ]);
            File::put('images/department/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $path);
        }
        $detail = $dom->savehtml();
        $input->description = $detail;
        $input->save();

        return redirect(route('admin.department.index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil menambahkan klinik spesialis');
    }

    public function getEdit($id)
    {
        $data['department'] = Department::find($id);

        return view('admin.department.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'quotes' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'deskripsi' => 'required',
        ]);

        $department = Department::find($id);
        $department->title = $request->nama;
        $department->quotes = $request->quotes;

        if ($request->file('logo') != "") {
            File::delete($department->image);
            //UPLOAD FOTO SAMPUL
            $extension = $request->file('logo')->getClientOriginalExtension();
            $location = 'images/department/';
            $nameUpload = $department->id . '-' . $department->title . '.' . $extension;
// $request->file('logo')->move('assets/' . $location, $nameUpload);
            File::put($location . $nameUpload, $request->file('logo'));
// dd($request->file('logo'));
            $filepath = $location . "/" . $nameUpload;
            $department->image = $filepath;
        }

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
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $id . '-' . $k . '-' . time() . '.png';
                $path = '/images/department/' . $image_name;
                DepartmentImage::create([
                    'path' => $path,
                    'department_id' => $id,
                ]);
                File::put('images/department/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', $path);
            }
        }
        $detail = $dom->savehtml();
        $department->description = $detail;
        $department->save();

        return redirect(route('admin.department.index'))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil merubah data Klinik Spesialis.');
    }

    public function delete($id)
    {
        $product = Department::find($id);
        $foto = DepartmentImage::where('department_id', $id)->get();
        foreach ($foto as $f) {
            File::delete(substr($f->path, 1));
        }
        $product->delete();
        // Session::flash('icon', 'success');
        // Session::flash('title', 'Berhasil');
        // Session::flash('text', 'Berhasil Menghapus!');
        // return response()->json(['OK' => 200]);

        return redirect(route('admin.department.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus klinik spesialis!');
    }
}
