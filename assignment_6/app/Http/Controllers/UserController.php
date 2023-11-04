<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $user = Auth::user();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->bio = $request->bio;
        $user->save();
        return redirect()->back()->with('success', 'User profile updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
