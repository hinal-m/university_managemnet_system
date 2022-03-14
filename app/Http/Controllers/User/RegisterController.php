<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\College\StoreRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function registerFormShow()
    {
        return view('User.Auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'contact_no' => $request['contact'],
            'gender' => $request['gender'],
            'adhaar_card_no' => $request['adhaar_no'],
            'dob' => $request['dob'],
            $image = uploadFile($request['image'], 'student'),
            'image' => $image,
            'password' => Hash::make($request['password']),
        ]);
        $user->notify(new WelcomeEmailNotification($user));
        if ($user) {
            return redirect()->back()->with('success','Please Check Your Mail..Than After Login');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, failed to register');
        }
    }
}
