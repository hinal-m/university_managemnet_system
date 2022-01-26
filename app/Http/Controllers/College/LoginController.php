<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginShow(){
        return view('College.Auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:colleges,email',
            'password' => 'required|min:3|max:30'
        ], [
            'email.exists' => 'This email is not exists on colleges table',
        ]);
        $creds = $request->only('email', 'password');

        if (Auth::guard('college')->attempt($creds)) {
            return redirect()->route('college.dashboard');
        } else {
            return redirect()->route('college.college.login')->with('fail', 'Incorrect credentials');
        }
    }

    public function logout()
    {
        Auth::guard('college')->logout();
        return redirect()->route('college.college.login');
    }
}
