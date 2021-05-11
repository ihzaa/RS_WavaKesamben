<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartmentDoctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index($dokter_id)
    {
        $data = [];
        $data['dokter'] = DepartmentDoctor::find($dokter_id);
        $data['list'] = DoctorSchedule::all();
        return view('admin.schedule.index', compact('data'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'days' => 'required',
            'start' => 'required',
        ]);
        // dd($request->days);
        foreach ($request->days as $d) {
            // dd(gettype($d));
            DoctorSchedule::create([
                'days' => $d,
                'start' => $request->start,
                'end' => $request->end,
                'department_doctor_id' => $request->dokter_id,
            ]);
        }

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambahkan!');
    }

    public function edit($id, Request $request)
    {
        $validated = $request->validate([
            'days' => 'required',
            'start' => 'required',
        ]);

        DoctorSchedule::find($id)->update([
            'days' => $request->days,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function delete(Request $request)
    {
        DoctorSchedule::find($request->id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
