<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\SambutanDirektur;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data = [];
        $data['item'] = Profile::find($id);

        return view('user.profile.profile', compact('data'));
    }
    public function sambutanDirektur()
    {
        $data = [];
        $data['item'] = SambutanDirektur::first();
        return view('user.profile.sambutanDirektur', compact('data'));
    }
}
