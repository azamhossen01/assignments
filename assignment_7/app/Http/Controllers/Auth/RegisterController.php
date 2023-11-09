<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function userRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'username' => 'required|max:20|min:3|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|max:12|min:6',
            'bio' => 'max:500'
        ]);
        $user = DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            // If the user was successfully inserted, you can attempt to log them in
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // User is now logged in
                return redirect('home')->with('success', 'User Registration successful.');
                // Redirect to the dashboard or some other page
            }
        } else {
            // If the user was not successfully inserted, handle the error
            return back()->with('error', 'User registration failed.');
        }
        
    }
}
