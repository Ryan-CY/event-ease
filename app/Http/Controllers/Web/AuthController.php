<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' =>'required'
        ]);

        if (!Auth::attempt($request->only(['email', 'password'])))
        {
            return back()->withErrors([
                'email' => 'The provided credential are incorrect.'
            ]);
        }

        $request->session()->regenerate(); // prevent session fixation attack

        return redirect()->route('events.index')->with('success', 'Login successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // for CSRF Token（Cross-Site Request Forgery）

        return redirect()->route('events.index')->with('success', 'Logout successfully');
    }
}
