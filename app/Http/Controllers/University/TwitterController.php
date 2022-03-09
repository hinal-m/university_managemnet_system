<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirectToTwitter()
    {
        // dd(1);
        return Socialite::driver('twitter')->redirect();

    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleTwitterCallback()
    {
        // dd(2);
        try {
      
            // $university = Socialite::driver('twitter')->user();
            $university = Socialite::driver('twitter')->user();
            dd($university);
       
            $findUniversity = University::where('twitter_id', $university->id)->first();
       
            if($findUniversity){
       
                Auth::guard('university')->login($findUniversity);
            return redirect()->route('university.dashboard');
       
            }else{
                $newUser = University::create([
                    'name' => $university->name,
                    'email' => $university->email,
                    'google_id'=> $university->id,
                    'oauth_type'=> 'twitter',
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
