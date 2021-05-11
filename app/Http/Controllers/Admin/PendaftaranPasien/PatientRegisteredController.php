<?php

namespace App\Http\Controllers\Admin\PendaftaranPasien;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Patient;
use App\Models\PatientRegistration;
use App\Models\PatientRegistrationData;
use App\Models\PatientRegistrationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientRegisteredController extends Controller
{
    public function index(Request $request)
    {

        $query = 'SELECT prd.kode_daftar, pr.title as tipe, p.name as pasien , dep.title as spesialis, depd.name as dokter, ds.days,ds.start,ds.end, prd.created_at as created_at FROM `patient_registration_data` as prd JOIN patient_registrations as pr ON prd.patient_registration_id = pr.id JOIN patients as p ON prd.patient_id = p.id JOIN departments as dep ON prd.department_id = dep.id JOIN department_doctors as depd ON prd.department_doctor_id = depd.id JOIN doctor_schedules as ds ON prd.doctor_schedule_id = ds.id ';



        $data = [];
        $data['category'] = [
            "klinik" => $request->klinik,
            "tipe" => $request->tipe,
        ];

        if ($request->klinik != null && $request->tipe != null) {
            $query .= 'WHERE prd.department_id = ' . $request->klinik . ' AND  prd.patient_registration_id = ' . $request->tipe . ' ';
        } else if ($request->klinik != null && $request->tipe == null) {
            $query .= 'WHERE prd.department_id = ' . $request->klinik . ' ';
        } else if ($request->klinik == null && $request->tipe != null) {
            $query .= 'WHERE prd.patient_registration_id = ' . $request->tipe . ' ';
        }

        $query .= 'GROUP BY prd.kode_daftar ORDER BY prd.created_at DESC';
        $data['item'] = DB::select($query);
        $data['listKlinik'] = Department::orderBy('title')->get();
        $data['listTipe'] = PatientRegistration::orderBy('title')->get();
        return view('admin.patientRegistration.patientRegistered.index', compact('data'));
    }

    public function getDetailRegistrationData($kode)
    {
        $data = [];
        $data['item'] = DB::select('SELECT prd.id as id_data, prd.answare, prf.name, prf.type, p.id as pasien, prd.created_at as created_at FROM `patient_registration_data` as prd JOIN patient_registration_forms as prf ON prd.patient_registration_form_id = prf.id JOIN patients as p ON prd.patient_id = p.id WHERE prd.kode_daftar = "' . $kode . '"');
        $data['pasien'] = Patient::find($data['item'][0]->pasien);
        $data['relasi'] = DB::select('SELECT DISTINCT prd.kode_daftar, pr.title as tipe, p.name as pasien , dep.title as spesialis, depd.name as dokter, ds.days,ds.start,ds.end FROM `patient_registration_data` as prd JOIN patient_registrations as pr ON prd.patient_registration_id = pr.id JOIN patients as p ON prd.patient_id = p.id JOIN departments as dep ON prd.department_id = dep.id JOIN department_doctors as depd ON prd.department_doctor_id = depd.id JOIN doctor_schedules as ds ON prd.doctor_schedule_id = ds.id WHERE prd.kode_daftar = "' . $kode . '"')[0];
        return response()->json($data);
    }

    public function downloadFile($id)
    {
        $data = PatientRegistrationData::find($id);
        $file_path = public_path($data->answare);
        return response()->download($file_path);
    }
}
