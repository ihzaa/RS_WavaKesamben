<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentDoctor;
use Illuminate\Http\Request;

class ClinicSpecialisController extends Controller
{
    public function index()
    {
        $data = [];
        $data['item'] = Department::all();

        return view('user.spesialis.listClinic', compact('data'));
    }

    public function detail($id)
    {
        $data = [];
        $data['item'] = Department::find($id);
        $data['schedule'] = DepartmentDoctor::where('department_id', $id)->with('schedule')->get();
        return view('user.spesialis.detail', compact('data'));
    }
}
