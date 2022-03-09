<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\College;
use Exception;
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
      
            $college = Socialite::driver('google')->user();
            // dd($college);
       
            $findCollege = College::where('google_id', $college->id)->first();
       
            if($findCollege){
       
                Auth::guard('college')->login($findCollege);
            return redirect()->route('college.dashboard');
       
            }else{
                $newUser = College::create([
                    'name' => $college->name,
                    'email' => $college->email,
                    'google_id'=> $college->id,
                    'status' => '1',
                    'password' => uniqid()
                ]);
      
                Auth::guard('college')->login($newUser);
            return redirect()->route('college.dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
