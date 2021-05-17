<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use App\Models\Profile;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function getAllData()
    {
        $data = array();
        $data['featuredProduct'] = FeaturedProduct::get(['id', 'title']);
        $data['profile'] = Profile::get(['id', 'title']);
        return response()->json($data);
    }
}
