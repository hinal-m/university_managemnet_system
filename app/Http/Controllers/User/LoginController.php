<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginFormShow()
    {
        return view('User.Auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:3|max:30'
        ], [
            'email.exists' => 'This email is not exists on users table',
        ]);
        $creds = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($creds)) {
            return redirect()->route('user.addmission.create');
        } else {
            return redirect()->route('user.login')->with('fail', 'Incorrect credentials');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }

}
