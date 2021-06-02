<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AgendaActivity;
use App\Models\GaleriInstagram;
use Illuminate\Support\Facades\DB;

class InstagramController extends Controller
{
    public function detail($id)
    {
        $data = [];
        $data['content'] = GaleriInstagram::find($id);
        $data['instagram'] = GaleriInstagram::orderBy('id', 'desc')->limit(6)->get();
        $data['count'] = DB::select('SELECT healthy_info_count.c1 as healthy_info_count, agenda_activities_count.c1 as agenda_activities_count, testimonials_count.c1 as testimonials_count FROM (select count(*) as c1 FROM healty_infos) as healthy_info_count , (select count(*) as c1 FROM agenda_activities) as agenda_activities_count, (SELECT COUNT(*) as c1 FROM testimonials) as testimonials_count')[0];
        $data['recent'] = AgendaActivity::orderBy('id', 'desc')->limit(5)->get();
        return view('user.instagram.detail', compact('data'));
    }
}
