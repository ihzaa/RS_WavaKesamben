<?php

namespace App\Http\Controllers\Admin\PendaftaranPasien;

use App\Http\Controllers\Controller;
use App\Models\PatientRegistration;
use App\Models\PatientRegistrationForm;
use Illuminate\Http\Request;

class RegistrationMenuController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = PatientRegistration::all();

        return view('admin.patientRegistration.registrationMenu.index', compact('data'));
    }

    public function getAdd()
    {
        return view('admin.patientRegistration.registrationMenu.add');
    }

    public function postAdd(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
        $data = PatientRegistration::create([
            'title' => $request->judul,
            'description' => $request->deskripsi
        ]);

        foreach ($request->nama_form as $k => $v) {
            PatientRegistrationForm::create([
                'name' => $v,
                'type' => $request->jenis_form[$k],
                'patient_registration_id' => $data->id
            ]);
        }

        return redirect(route('admin.patientRegistration.registrationMenu.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function changeStatus($id)
    {
        $data = PatientRegistration::find($id);
        if ($data->isActive) {
            $data->isActive = 0;
        } else {
            $data->isActive = 1;
        }
        $data->save();
        return response()->json(['status' => 'ok']);
    }

    public function delete($id)
    {
        PatientRegistration::find($id)->delete();

        return redirect(route('admin.patientRegistration.registrationMenu.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }

    public function getEdit($id)
    {
        $data = [];
        $data['item'] = PatientRegistration::find($id);
        $data['form'] = PatientRegistrationForm::where('patient_registration_id', $id)->get();
        return view('admin.patientRegistration.registrationMenu.edit', compact('data'));
    }

    public function postEdit($id, Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);
        PatientRegistration::find($id)->update([
            'title' => $request->judul,
            'description' => $request->deskripsi
        ]);
        return redirect(route('admin.patientRegistration.registrationMenu.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }
}
