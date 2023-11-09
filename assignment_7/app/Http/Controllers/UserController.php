<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function profile()
    {
        return view('pages.user.profile');
    }

    public function editProfile()
    {
        return view('pages.user.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required',
            'bio' => 'max:200'
        ]);
        DB::table('users')
        ->where('id', Auth::id())
        ->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : Auth::user()->password,
            'bio' => $request->bio
        ]);
        return redirect()->back()->with('success', 'User profile updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
