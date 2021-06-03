<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact.contact');
    }

    public function addTestimoni(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required',
            'name' => 'required',
        ]);

        Testimonial::create([
            'description' => $request->message,
            'name' => $request->name,
        ]);

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Pesan dan kesan berhasil dikirimkan');

    }
}
