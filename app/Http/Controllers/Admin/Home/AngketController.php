<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Angket;
use App\Models\AngketJawaban;
use Illuminate\Http\Request;

class AngketController extends Controller
{
    public function index()
    {
        $data = [];
        $data['angket'] = Angket::all();
        return view('admin.home.angket.index', compact('data'));
    }

    public function addQuestion(Request $request)
    {
        Angket::create([
            'pertanyaan' => $request->pertanyaan
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menambahkan!');
    }

    public function editQuestion($id, Request $request)
    {
        Angket::find($id)->update([
            'pertanyaan' => $request->pertanyaan
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Merubah!');
    }

    public function deleteQuestion(Request $request)
    {
        Angket::find($request->id)->delete();

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menghapus!');
    }

    public function getAnswarePerQuestion($id)
    {
        $data = AngketJawaban::where('angket_id', $id)->withCount('jawabanPengguna')->get();

        return response()->json(['data' => $data, 'id' => $id]);
    }

    public function addAnsware($id, Request $request)
    {
        AngketJawaban::create([
            'angket_id' => $id,
            'jawaban' => $request->jawaban
        ]);

        return $this->getAnswarePerQuestion($id);
    }

    public function deleteAnsware($question, $id)
    {
        AngketJawaban::find($id)->delete();
        return $this->getAnswarePerQuestion($question);
    }
}
