<?php

namespace App\Http\Controllers\User\HealthyPromotion;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimoniController extends Controller
{
    public function index()
    {
        $data['item'] = Testimonial::where('is_accepted',1)->orderBy('id', 'desc')->paginate(5);

        return view('user.healthyPromotion.testimoni.testimoni', compact('data'));
    }
}
