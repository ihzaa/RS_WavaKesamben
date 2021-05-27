<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AgendaActivity;
use App\Models\FeaturedProduct;
use App\Models\PatientRegistration;
use App\Models\Profile;
use App\Models\Service;
use Illuminate\Http\Request;

class HeaderFooterController extends Controller
{
    public function getAllData()
    {
        $data = array();
        // header
        $data['featuredProduct'] = FeaturedProduct::get(['id', 'title']);
        $data['profile'] = Profile::get(['id', 'title']);
        $data['service'] = Service::get(['id', 'title']);
        $data['registration'] = PatientRegistration::get(['id', 'title']);

        // footer
        $data['agendaActivity'] = AgendaActivity::orderBy('id','desc')->limit(4)->get();
        return response()->json($data);
    }
}
