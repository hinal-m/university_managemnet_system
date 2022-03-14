<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()       
    {
        try {

            $university = Socialite::driver('github')->stateless()->user();

            $findUniversity = University::where('github_id', $university->id)->first();

            if ($findUniversity) {

                Auth::guard('university')->login($findUniversity);
                return redirect()->route('university.dashboard');
            } else {
                $newUser = University::create([
                    'name' => $university->name,
                    'email' => $university->email,
                    'github_id' => $university->id,
                    'github_type'=> 'github',
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
