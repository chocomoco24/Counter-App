<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect('/admin/dashboard')
                : redirect('/student/dashboard');
        }
        return view('auth.login');
    }

    // Handle login form submit
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return Auth::user()->isAdmin()
                ? redirect('/admin/dashboard')
                : redirect('/student/dashboard');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout (works for both admin and student)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}