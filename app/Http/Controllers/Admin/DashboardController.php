<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentDoctor;
use App\Models\FeaturedProduct;
use App\Models\Patient;
use App\Models\PatientRegistration;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['newPatient'] = $this->getUnprocessedPatient();
        $data['total_patient'] = Patient::where('accepted', '1')->count();
        $data['total_product'] = FeaturedProduct::count();
        $data['total_department'] = Department::count();
        $data['total_service'] = Service::count();
        $data['total_doctor'] = DepartmentDoctor::count();
        $data['doctor'] = DepartmentDoctor::all();

        // dd($data['promo_count']);
        return view('admin.home.dashboard', compact("data"));
    }

    public function getUnprocessedPatient()
    {
        return PatientRegistration::where('isActive', "0")->count();
    }
}
