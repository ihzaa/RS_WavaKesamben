<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();
        // kondisi salah
        if ($admin == []) {
            return back()->with('icon', 'error')->with('title', 'Maaf!')->with('text', 'Username atau Password Salah!');
        }
        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('icon', 'error')->with('title', 'Maaf!')->with('text', 'Username atau Password Salah!');
        }
        // end kondisi salah
        else {
            $remember = $request->has('remember') ? true : false;
            Auth::guard('admin')->loginUsingId($admin->id, $remember);
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login.get'));
    }
}
