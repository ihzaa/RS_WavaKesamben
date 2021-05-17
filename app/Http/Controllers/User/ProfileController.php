<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data = [];
        $data['item'] = Profile::find($id);
        
    }
}
