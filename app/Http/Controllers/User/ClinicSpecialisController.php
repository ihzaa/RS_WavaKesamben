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
        if ($data['item'] == []) {
            return redirect(route('user.home'));
        }
        $data['schedule'] = DepartmentDoctor::where('department_id', $id)->with('schedule')->get();
        return view('user.spesialis.detail', compact('data'));
    }

    public function dokter($id)
    {
        $data = [];
        $data['item'] = DepartmentDoctor::where('id', $id)->with('schedule', 'department')->get();
        if (count($data['item']) != 0) {
            $data['item'] = $data['item'][0];
            $data['dokter'] = DepartmentDoctor::where('department_id', $data['item']->department->id)->where('id', '!=', $id)->limit(10)->get();
            return view('user.spesialis.doctor', compact('data'));
        }
        return redirect(route('user.home'));
    }
}
