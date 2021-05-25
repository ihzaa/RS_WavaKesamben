<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KualitasMutuBulan;
use App\Models\KualitasMutuDescription;
use App\Models\KualitasMutuTahun;

class QualityController extends Controller
{
    //Tahun
    public function showYear()
    {
        $data = [];
        $data['quality'] = KualitasMutuTahun::orderBy('year', 'asc')->get();
        $data['count'] = KualitasMutuTahun::orderBy('year', 'asc')->count();

        return view('user.quality.year', compact('data'));
    }

    public function showMonth($id, $year)
    {
        $data = [];
        $data['year'] = $year;
        $data['year_id'] = $id;
        $data['quality'] = KualitasMutuBulan::where('kualitas_mutu_tahun_id', $id)->get();
        $data['count'] = KualitasMutuBulan::where('kualitas_mutu_tahun_id', $id)->count();

        return view('user.quality.month', compact('data'));
    }

    public function showData($id, $year, $month_id, $month)
    {
        $data = [];
        $data['year'] = $year;
        $data['year_id'] = $id;
        $data['month'] = $month;
        $data['month_id'] = $month_id;
        $data['quality'] = KualitasMutuDescription::where('kualitas_mutu_bulan_id', $month_id)->get();
        $data['count'] = KualitasMutuDescription::where('kualitas_mutu_bulan_id', $month_id)->count();

        // dd($data['quality']);
        return view('user.quality.detail', compact('data'));
    }
}
