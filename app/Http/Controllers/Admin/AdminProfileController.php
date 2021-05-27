<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profileManagement.index');
    }

    public function changePassword(Request $request){
        $usr = DB::table('admins')->where('id', Auth::id())->first();
        if (Hash::check($request->old, $usr->password)) {
            Admin::whereId(Auth::id())->update([
                'password' => Hash::make($request->new)
            ]);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
