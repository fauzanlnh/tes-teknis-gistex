<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/dashboard'); // Redirect to the intended page after login
        }

        // Authentication failed
        return back()->with('error', 'Email atau Password salah')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
