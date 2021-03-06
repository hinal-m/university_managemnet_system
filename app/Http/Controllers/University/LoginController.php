<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\Captcha;

class LoginController extends Controller
{
    public function loginShow(){
        return view('University.Auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:universities,email',
            'password' => 'required|min:3|max:30',
            // 'captcha' => 'required|captcha',
            'g-recaptcha-response' => new Captcha(),
        ], [
            'captcha.captcha'=>'Invalid captcha code.',
            'email.exists' => 'This email is not exists on admins table',
        ]);
        $creds = $request->only('email', 'password');

        if (Auth::guard('university')->attempt($creds)) {
            return redirect()->route('university.dashboard');
        } else {
            return redirect()->route('university.university.login')->with('fail', 'Incorrect credentials');
        }
    }

    public function logout()
    {
        Auth::guard('university')->logout();
        return redirect()->route('university.university.login');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
