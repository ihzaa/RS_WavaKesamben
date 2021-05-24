<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KualitasMutuTahun;

class QualityController extends Controller
{
    //Tahun
    public function indexYear()
    {
        $data = [];
        $data['quality'] = KualitasMutuTahun::orderBy('year', 'asc')->get();

        return view('user.quality.year', compact('data'));
    }
}
