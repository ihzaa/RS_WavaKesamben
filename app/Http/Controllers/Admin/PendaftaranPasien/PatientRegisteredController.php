<?php

namespace App\Http\Controllers\Admin\PendaftaranPasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientRegisteredController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] ;

        return view('admin.patientRegistration.patientRegistered.index', compact('data'));
    }
}
