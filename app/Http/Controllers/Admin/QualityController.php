<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KualitasMutuTahun;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    public function indexYear()
    {
        $data = [];
        $data['quality'] = KualitasMutuTahun::orderBy('year', 'asc')->get();

        return view('admin.quality.index', compact('data'));
    }

    public function addYear(Request $request)
    {
        KualitasMutuTahun::create([
            'year' => $request->year,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function deleteYear(Request $request)
    {
        KualitasMutuTahun::find($request->id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
