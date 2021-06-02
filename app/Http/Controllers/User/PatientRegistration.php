<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\NewPatientRegistrationRequest;
use App\Jobs\SendEmail;
use App\Mail\Patient\RegisterToDepartment;
use App\Models\Department;
use App\Models\DepartmentDoctor;
use App\Models\DoctorSchedule;
use App\Models\Patient;
use App\Models\PatientRegistration as ModelsPatientRegistration;
use App\Models\PatientRegistrationData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PatientRegistration extends Controller
{
    public function newPatient()
    {
        return view('user.patientRegistration.newPatient');
    }

    public function storeNewPatientRegistrationData(NewPatientRegistrationRequest $request)
    {
        $patient = Patient::create([
            'nomer' => 'tmp',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'ktp' => 'tmp',
            'kk' => 'tmp'
        ]);

        $patient->nomer = str_pad($patient->id, 10, '0', STR_PAD_LEFT);

        //UPLOAD FOTO KTP
        $extension = $request->file('ktp')->getClientOriginalExtension();
        // File upload location
        $location = 'images/patient/ktp';
        $nameUpload = $patient->id . 'ktp.' . $extension;
        // Upload file
        $request->file('ktp')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $patient->ktp = $filepath;

        //UPLOAD FOTO KK
        $extension = $request->file('kk')->getClientOriginalExtension();
        // File upload location
        $location = 'images/patient/kk';
        $nameUpload = $patient->id . 'kk.' . $extension;
        // Upload file
        $request->file('kk')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $patient->kk = $filepath;

        $patient->save();
        return back()->with('icon', 'success')->with('title', 'Pendaftaran anda berhasil!')->with('text', 'Anda akan menerima email jika pendaftaran ada telah di validasi admin.');
    }

    public function menuRegistration($id)
    {
        $data['item'] = ModelsPatientRegistration::with('form')->find($id);
        $data['spesialis'] = Department::get(['id', 'title']);
        return view('user.patientRegistration.registrationToSpesialis', compact('data'));
    }

    public function menuRegistrationPost($id, Request $request)
    {
        // return $request;
        $form = ModelsPatientRegistration::with('form')->find($id);
        $patient = Patient::where('nomer', $request->nomer)->first();
        do {
            $kode_daftar = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
            $isExist = PatientRegistrationData::where('kode_daftar', $kode_daftar)->count();
        } while ($isExist != 0);
        foreach ($form->form as $item) {
            if ($item->type == 'file') {
                //UPLOAD
                $extension = $request->file($item->id)->getClientOriginalExtension();
                // File upload location
                $location = 'images/patient/registration';
                $nameUpload =  $kode_daftar . '-' . $item->id . '.' . $extension;
                // Upload file
                $request->file($item->id)->move($location, $nameUpload);
                $filepath = $location . "/" . $nameUpload;
                PatientRegistrationData::create([
                    'kode_daftar' => $kode_daftar,
                    'answare' => $filepath,
                    'patient_registration_id' => $id,
                    'patient_registration_form_id' => $item->id,
                    'patient_id' => $patient->id,
                    'department_id' => $request->spesialis,
                    'department_doctor_id' => $request->dokter,
                    'doctor_schedule_id' => $request->time
                ]);
            } else {
                PatientRegistrationData::create([
                    'kode_daftar' => $kode_daftar,
                    'answare' => $request[$item->id],
                    'patient_registration_id' => $id,
                    'patient_registration_form_id' => $item->id,
                    'patient_id' => $patient->id,
                    'department_id' => $request->spesialis,
                    'department_doctor_id' => $request->dokter,
                    'doctor_schedule_id' => $request->time
                ]);
            }
        }

        $info_dokter = DB::select('SELECT ds.days, ds.start, ds.end, dd.name, d.title FROM doctor_schedules as ds JOIN department_doctors as dd ON ds.department_doctor_id = dd.id JOIN departments as d ON dd.department_id = d.id WHERE ds.id = "' . $request->time . '"');
        // Mail::to($patient->email)->send(new RegisterToDepartment([
        //     'kode_daftar' => $kode_daftar,
        //     'pasien' => $patient,
        //     'info_dokter' => $info_dokter[0],
        //     'waktu' => Carbon::now()->translatedFormat('H:i - l, d M Y')
        // ]));
        dispatch(new SendEmail(new RegisterToDepartment([
            'kode_daftar' => $kode_daftar,
            'pasien' => $patient,
            'info_dokter' => $info_dokter[0],
            'waktu' => Carbon::now()->translatedFormat('H:i - l, d M Y')
        ]), $patient->email));
        return back()->with('icon', 'success')->with('title', 'Pendaftaran anda berhasil!')->with('text', 'Anda akan menerima email kode pendaftaran.');
    }

    public function getPatientData($nomer)
    {
        $data = Patient::where('nomer', $nomer)->first();
        if ($data != []) {
            return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200);
        }
        return response()->json([
            'message' => 'fail'
        ], 500);
    }

    public function getDoctorPerDepartment($id)
    {
        $data = DepartmentDoctor::where('department_id', $id)->where('isLeave', 0)->get(['id', 'name']);

        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    public function getDoctorSchedule($id)
    {

        $days = [
            'Minggu' => 'Senin',
            'Senin' => 'Selasa',
            'Selasa' => 'Rabu',
            'Rabu' => 'Kamis',
            'Kamis' => 'Jumat',
            'Jumat' => 'Sabtu',
            'Sabtu' => 'Minggu'
        ];
        $data = DoctorSchedule::where('department_doctor_id', $id)->where('days', $days[Carbon::now()->translatedFormat('l')])->orWhere('days', Carbon::now()->translatedFormat('l'))->get();

        return response()->json([
            'message' => 'success',
            'data' => $data,
        ]);
    }
}
