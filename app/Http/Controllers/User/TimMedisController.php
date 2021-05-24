<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class TimMedisController extends Controller
{
    public function index()
    {
        $data = [];
        $data['department'] = Department::orderBy('title','asc')->with('doctors')->get();

        return view('user.timMedis.index', compact('data'));
    }
}
