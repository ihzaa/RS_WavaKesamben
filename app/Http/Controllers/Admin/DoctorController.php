<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentDoctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    public function index($id)
    {
        $data = array();
        $data['department'] = Department::find($id);
        $data['list'] = DepartmentDoctor::where('department_id', $id)->get();
        return view('admin.doctor.index', compact('data'));
    }

    public function getAdd($id)
    {
        $data = array();
        $data['department'] = Department::find($id);
        return view('admin.doctor.add', compact('data'));
    }

    public function postAdd(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
        ]);

        if ($request->isLeave == null) {
            $input = DepartmentDoctor::create([
                'name' => $request->nama,
                'isLeave' => 0,
                'image' => 'temp',
                'description' => $request->deskripsi,
                'department_id' => $id,
            ]);

        } else {
            $input = DepartmentDoctor::create([
                'name' => $request->nama,
                'isLeave' => 1,
                'image' => 'temp',
                'description' => $request->deskripsi,
                'department_id' => $id,
            ]);

        }

        //UPLOAD DOCTOR IMAGE
        $extension = $request->file('image')->getClientOriginalExtension();
        $location = 'images/doctor';
        $nameUpload = $input->id . '-' . $input->name . '.' . $extension;
        $request->file('image')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $input->image = $filepath;

        //Membuat Jadwal Praktek
        DoctorSchedule::create([
            'days' => '',
            'start' => 0,
            'end' => 'temp',
            'department_doctor_id' => $input->id,
        ]);

        $input->save();

        return redirect(route('admin.department.doctor.index', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil menambahkan dokter spesialis');
    }

    public function getEdit($id, $dokter_id)
    {
        $data['doctor'] = DepartmentDoctor::find($dokter_id);
        $data['department'] = Department::find($id);

        return view('admin.doctor.edit', compact('data'));
    }

    public function postEdit($id, $dokter_id, Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500',
        ]);

        $doctor = DepartmentDoctor::find($dokter_id);
        $doctor->name = $request->nama;
        $doctor->description = $request->deskripsi;
        $doctor->department_id = $id;

        if ($request->isLeave == null) {
            $doctor->isLeave = 0;
        } else {
            $doctor->isLeave = 1;
        }

        if ($request->file('image') != "") {
            File::delete($doctor->image);
            //UPLOAD FOTO SAMPUL
            $extension = $request->file('image')->getClientOriginalExtension();
            $location = 'images/doctor';
            $nameUpload = $doctor->id . '-' . $doctor->name . '.' . $extension;
            $request->file('image')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $doctor->image = $filepath;
        }

        $doctor->save();

        return redirect(route('admin.department.doctor.index', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Berhasil merubah data dokter.');
    }

    public function delete($id, $dokter_id)
    {
        $doctor = DepartmentDoctor::find($dokter_id);
        File::delete($doctor->image);
        // $foto = DepartmentDoctorImage::where('doctor_id', $id)->get();
        // foreach ($foto as $f) {
        //     File::delete(substr($f->path, 1));
        // }
        $doctor->delete();

        return redirect(route('admin.department.doctor.index', ['id' => $id]))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus dokter!');
    }
}
