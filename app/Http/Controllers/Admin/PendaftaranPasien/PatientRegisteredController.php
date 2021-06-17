<?php

namespace App\Http\Controllers\Admin\PendaftaranPasien;

use App\Http\Controllers\Controller;
use App\Mail\Patient\RegisterToDepartment;
use App\Mail\Patient\RejectRegisterToDepartment;
use App\Models\Department;
use App\Models\Patient;
use App\Models\PatientRegistration;
use App\Models\PatientRegistrationData;
use App\Models\PatientRegistrationForm;
use App\Models\PatientRegistrationFormAnsware;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

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
        $data['main_info'] = DB::select('SELECT prd.kode_daftar, prd.created_at, prd.is_accept , d.title as department_name ,dd.name as doctor_name,ds.days,ds.start,ds.end, pr.title as menu_name, p.nomer,p.name AS patient_name,p.phone FROM patient_registration_data as prd JOIN departments as d ON d.id = prd.department_id JOIN department_doctors as dd ON dd.id = prd.department_doctor_id JOIN doctor_schedules as ds ON ds.id = prd.doctor_schedule_id JOIN patients as p ON p.id = prd.patient_id JOIN patient_registrations as pr ON pr.id = prd.patient_registration_id WHERE prd.kode_daftar = "' . $kode . '"')[0];
        $registrationId = PatientRegistrationData::where('kode_daftar', $kode)->first();
        $data['detail'] = DB::select('SELECT * FROM `patient_registration_form_answare` AS prfa JOIN patient_registration_forms as prf ON prf.id = prfa.patient_registration_form_id WHERE prfa.patient_registration_data_id = "' . $registrationId->id . '"');
        return response()->json($data);
    }

    public function downloadFile($id)
    {
        $data = PatientRegistrationData::find($id);
        $file_path = public_path($data->answare);
        return response()->download($file_path);
    }

    public function acceptDepartmentRegistration($kode)
    {
        $pendaftaran = PatientRegistrationData::where('kode_daftar', $kode)->first();
        $patient = Patient::find($pendaftaran->patient_id);
        $info_dokter = DB::select('SELECT ds.days, ds.start, ds.end, dd.name, d.title FROM doctor_schedules as ds JOIN department_doctors as dd ON ds.department_doctor_id = dd.id JOIN departments as d ON dd.department_id = d.id WHERE ds.id = "' . $pendaftaran->doctor_schedule_id . '"');
        Mail::to($patient->email)->send(new RegisterToDepartment([
            'kode_daftar' => $kode,
            'pasien' => $patient,
            'info_dokter' => $info_dokter[0],
            'waktu' => Carbon::parse($pendaftaran->created_at)->translatedFormat('H:i - l, d M Y')
        ]));
        $pendaftaran->is_accept = 1;
        $pendaftaran->save();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menerima Pendaftaran!');
    }

    public function rejectDepartmentRegistration($kode)
    {
        $pendaftaran = PatientRegistrationData::where('kode_daftar', $kode)->first();
        $patient = Patient::find($pendaftaran->patient_id);
        $info_dokter = DB::select('SELECT ds.days, ds.start, ds.end, dd.name, d.title FROM doctor_schedules as ds JOIN department_doctors as dd ON ds.department_doctor_id = dd.id JOIN departments as d ON dd.department_id = d.id WHERE ds.id = "' . $pendaftaran->doctor_schedule_id . '"');
        Mail::to($patient->email)->send(new RejectRegisterToDepartment([
            'kode_daftar' => $kode,
            'pasien' => $patient,
            'info_dokter' => $info_dokter[0],
            'waktu' => Carbon::parse($pendaftaran->created_at)->translatedFormat('H:i - l, d M Y')
        ]));
        $answare = PatientRegistrationFormAnsware::where('patient_registration_data_id', $pendaftaran->id)->get();
        foreach ($answare as $a) {
            if (strpos($a->answare, 'images/patient') !== false) {
                File::delete($a->answare);

            }
        }
        PatientRegistrationFormAnsware::where('patient_registration_data_id',$pendaftaran->id)->delete();
        $pendaftaran->delete();
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menolak dan Menghapus Data Pendaftaran!');
    }
}
