<?php

namespace App\Http\Controllers\User\HealthyPromotion;

use App\Http\Controllers\Controller;
use App\Models\AgendaActivity;
use App\Models\GaleriInstagram;
use App\Models\HealtyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchPostController extends Controller
{
    public function indexHealthyInformation(Request $request)
    {
        $data = [];
        if ($request->keyword == '') {
            $data['item'] = HealtyInfo::orderBy('id', 'desc')->paginate(5);
        } else {
            $data['item'] = HealtyInfo::orderBy('id', 'desc')->where('title', 'like', '%' . $request->keyword . '%')->paginate(5);
            $data['item']->appends(['keyword' => $request->keyword]);
        }
        $data['instagram'] = GaleriInstagram::orderBy('id', 'desc')->limit(6)->get();
        $data['count'] = DB::select('SELECT healthy_info_count.c1 as healthy_info_count, agenda_activities_count.c1 as agenda_activities_count, testimonials_count.c1 as testimonials_count FROM (select count(*) as c1 FROM healty_infos) as healthy_info_count , (select count(*) as c1 FROM agenda_activities) as agenda_activities_count, (SELECT COUNT(*) as c1 FROM testimonials) as testimonials_count')[0];
        $data['recent'] = HealtyInfo::orderBy('id', 'desc')->limit(5)->get();
        $data['keyword'] = $request->keyword;
        return view('user.healthyPromotion.healthyInformation.list', compact('data'));
    }

    public function indexAgendaActivity(Request $request)
    {
        $data = [];
        if ($request->keyword == '') {
            $data['item'] = AgendaActivity::orderBy('id', 'desc')->paginate(5);
        } else {
            $data['item'] = AgendaActivity::orderBy('id', 'desc')->where('title', 'like', '%' . $request->keyword . '%')->paginate(5);
            $data['item']->appends(['keyword' => $request->keyword]);
        }
        $data['instagram'] = GaleriInstagram::orderBy('id', 'desc')->limit(6)->get();
        $data['count'] = DB::select('SELECT healthy_info_count.c1 as healthy_info_count, agenda_activities_count.c1 as agenda_activities_count, testimonials_count.c1 as testimonials_count FROM (select count(*) as c1 FROM healty_infos) as healthy_info_count , (select count(*) as c1 FROM agenda_activities) as agenda_activities_count, (SELECT COUNT(*) as c1 FROM testimonials) as testimonials_count')[0];
        $data['recent'] = AgendaActivity::orderBy('id', 'desc')->limit(5)->get();
        $data['keyword'] = $request->keyword;
        return view('user.healthyPromotion.agendaActivity.list', compact('data'));
    }
}
