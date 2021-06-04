<?php

namespace App\Http\Controllers\Admin\PendaftaranPasien;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\Patient\AcceptRegistration;
use App\Mail\Patient\RejectRegistration;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PasienController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = Patient::orderBy('id', 'desc')->get();

        return view('admin.patientRegistration.listPatient.index', compact('data'));
    }

    public function acceptRegistration($id)
    {
        $patient = Patient::find($id);
        Mail::to($patient->email)->send(new AcceptRegistration($patient));
        // dispatch(new SendEmail(new AcceptRegistration($patient), $patient->email));
        $patient->accepted = 1;
        $patient->save();
        return redirect(route('admin.patientRegistration.listPatient.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Pasien telah dikirimkan email nomer kartu!');
    }

    public function rejectRegistration($id)
    {
        $patient = Patient::find($id);
        Mail::to($patient->email)->send(new RejectRegistration($patient));
        // dispatch(new SendEmail(new RejectRegistration($patient), $patient->email));
        $patient->delete();

        return redirect(route('admin.patientRegistration.listPatient.index'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Pasien telah dikirimkan email penolakan pendaftaran!');
    }
}
