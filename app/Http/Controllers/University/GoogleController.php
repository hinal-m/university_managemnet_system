<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // dd(1);
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        // dd(2);
        try {
      
            $university = Socialite::driver('google')->user();
            // dd($university);
       
            $findUniversity = University::where('google_id', $university->id)->first();
       
            if($findUniversity){
       
                Auth::guard('university')->login($findUniversity);
            return redirect()->route('university.dashboard');
       
            }else{
                $newUser = University::create([
                    'name' => $university->name,
                    'email' => $university->email,
                    'google_id'=> $university->id,
                    'password' =>encrypt('admin@123')
                ]);
      
                Auth::guard('university')->login($newUser);
            return redirect()->route('university.dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
