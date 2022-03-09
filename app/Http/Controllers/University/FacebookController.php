<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        // dd(1);
        try {

            $university = Socialite::driver('facebook')->user();
            // dd($university);

            $findUniversity = University::where('facebook_id', $university->id)->first();

            if ($findUniversity) {

                Auth::guard('university')->login($findUniversity);
                return redirect()->route('university.dashboard');
            } else {
                $newUser = University::create([
                    'name' => $university->name,
                    'email' => $university->email,
                    'facebook_id' => $university->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::guard('university')->login($newUser);
                return redirect()->route('university.dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
