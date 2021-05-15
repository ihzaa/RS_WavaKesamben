<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Angket;
use App\Models\AngketJawaban;
use App\Models\Carousel;
use App\Models\Galeri;
use App\Models\GaleriInstagram;
use App\Models\HealtyInfo;
use App\Models\SambutanDirektur;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['carousel'] = Carousel::all();
        $data['sambutan_direktur'] = SambutanDirektur::first();
        $data['angket'] = Angket::all();
        $data['jawaban_angket'] = AngketJawaban::all();
        $data['galeri'] = Galeri::all();
        $data['instagram'] = GaleriInstagram::limit(10)->orderBy('created_at', 'desc')->get();
        $data['info_kesehatan'] = HealtyInfo::limit(10)->orderBy('created_at', 'desc')->get();
        return view('user.home', compact('data'));
    }

    public function submitAngket(Request $request)
    {
        foreach ($request->all() as $k => $v) {
            if ($k != "_token") {
                $angket_id = str_replace('pertanyaan_', '', $k);
            }
        }
        dd($request->all());
    }
}
