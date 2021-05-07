<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KualitasMutuBulan;
use App\Models\KualitasMutuDescription;
use App\Models\KualitasMutuTahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class QualityController extends Controller
{
    //Tahun
    public function indexYear()
    {
        $data = [];
        $data['quality'] = KualitasMutuTahun::orderBy('year', 'asc')->get();

        return view('admin.quality.year', compact('data'));
    }

    public function addYear(Request $request)
    {
        KualitasMutuTahun::create([
            'year' => $request->year,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function editYear($id, Request $request)
    {
        KualitasMutuTahun::find($id)->update([
            'year' => $request->year,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function deleteYear($id, Request $request)
    {
        KualitasMutuTahun::find($id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }

    //Bulan
    public function indexMonth($id)
    {
        $data = [];
        $data['year'] = KualitasMutuTahun::find($id);
        $data['month'] = KualitasMutuBulan::where('kualitas_mutu_tahun_id', $id)->get();

        return view('admin.quality.month', compact('data'));
    }

    public function addMonth($id, Request $request)
    {
        KualitasMutuBulan::create([
            'kualitas_mutu_tahun_id' => $id,
            'name' => $request->month,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function editMonth($id, Request $request)
    {
        KualitasMutuBulan::find($id)->update([
            'name' => $request->month,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function deleteMonth($id, Request $request)
    {
        KualitasMutuBulan::find($id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }

    //Data
    public function indexData($month_id)
    {
        $data = [];
        // $data['month'] = KualitasMutuBulan::find('id', $id);
        // $data['year'] = KualitasMutuTahun::where($id);
        $data['data'] = KualitasMutuDescription::where('kualitas_mutu_bulan_id', $month_id)->get();
        $data['date'] = DB::table('kualitas_mutu_bulans')
            ->join('kualitas_mutu_tahuns', 'kualitas_mutu_bulans.kualitas_mutu_tahun_id', '=', 'kualitas_mutu_tahuns.id')
            ->select('kualitas_mutu_bulans.*', 'kualitas_mutu_tahuns.year')
            ->where('kualitas_mutu_bulans.id', '=', $month_id)
            ->first();

        return view('admin.quality.detail', compact('data'));
    }

    public function addData($month_id, Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image|max:256',
            'judul' => 'required',
        ]);

        $quality = KualitasMutuDescription::create([
            'name' => $request->judul,
            'image' => 'temp',
            'kualitas_mutu_bulan_id' => $month_id,
        ]);

        //UPLOAD FOTO
        $extension = $request->file('foto')->getClientOriginalExtension();
        // File upload location
        $location = 'images/quality';
        $nameUpload = $quality->id . '-quality.' . $extension;
        // Upload file
        $request->file('foto')->move($location, $nameUpload);
        $filepath = $location . "/" . $nameUpload;
        $quality->image = $filepath;
        $quality->save();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function editData($month_id, $id, Request $request)
    {
        $validated = $request->validate([
            'foto' => 'image|max:256',
            'judul' => 'required',
        ]);

        $quality = KualitasMutuDescription::find($id);
        $quality->name = $request->judul;
        if ($request->file('foto') != "") {
            $extension = $request->file('foto')->getClientOriginalExtension();
            // File upload location
            $location = 'images/quality';
            $nameUpload = $quality->id . '-quality.' . $extension;
            // Upload file
            $request->file('foto')->move($location, $nameUpload);
            $filepath = $location . "/" . $nameUpload;
            $quality->image = $filepath;
        }
        $quality->save();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function deleteData($month_id, $id, Request $request)
    {
        $quality = KualitasMutuDescription::find($id);
        File::delete($quality->image);
        $quality->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }
}
