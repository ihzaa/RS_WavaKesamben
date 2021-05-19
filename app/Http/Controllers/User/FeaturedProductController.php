<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProduct;
use Illuminate\Http\Request;

class FeaturedProductController extends Controller
{
    public function index($id)
    {
        $data = array();
        $data['post'] = FeaturedProduct::find($id);
        $data['list'] = FeaturedProduct::where('id', '!=', $id)->limit(10)->get();
        return view('user.featuredProduct.index', compact('data'));
    }
}
