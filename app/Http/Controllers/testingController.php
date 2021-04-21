<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testingController extends Controller
{
    public function user()
    {
        return view('user.template.master');
    }

    public function admin()
    {
        return view('admin.template.master');
    }
}
