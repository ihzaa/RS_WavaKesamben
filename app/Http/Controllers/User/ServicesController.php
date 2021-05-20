<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index($id)
    {
        $data['post'] = Service::find($id);
        $data['list'] = Service::where('id', '!=', $id)->limit(10)->get();

        return view('user.service.index', compact('data'));
    }
}
