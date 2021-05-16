<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentDoctor;
use App\Models\FeaturedProduct;
use App\Models\Patient;
use App\Models\PatientRegistration;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        // $data['getChartData'] =

        $chartData = DB::select('select d.DATE, coalesce(COUNT(id), 0) AS TOTAL
      from (select DATE(NOW()) as DATE union all
      select DATE(DATE_SUB( NOW(), INTERVAL 1 DAY)) union all
      select DATE(DATE_SUB( NOW(), INTERVAL 2 DAY)) union all
      select DATE(DATE_SUB( NOW(), INTERVAL 3 DAY)) union all
      select DATE(DATE_SUB( NOW(), INTERVAL 4 DAY)) union all
      select DATE(DATE_SUB( NOW(), INTERVAL 5 DAY)) union all
      select DATE(DATE_SUB( NOW(), INTERVAL 6 DAY))) d left outer join
      patient_registration_data p on DATE(p.created_at) = d.DATE GROUP BY d.DATE ORDER BY d.DATE ASC');

        // $label = array();
        foreach ($chartData as $c) {
            $chartData['label'][] = Carbon::parse($c->DATE)->isoFormat('dddd');
            $chartData['data'][] = $c->TOTAL;
        }

        $data['chart_data'] = json_encode($chartData);

        return view('admin.home.dashboard', compact("data"));
    }

    public function getUnprocessedPatient()
    {
        return PatientRegistration::where('isActive', "0")->count();
    }
}
