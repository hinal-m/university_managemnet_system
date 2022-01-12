<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\College\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function registerFormShow()
    {
        return view('User.Auth.register');
    }
    public function register(Request $request)
    {
        $collge = new User();
        $collge->name = $request->name;
        $collge->email = $request->email;
        $collge->address = $request->address;
        $collge->contact_no = $request->contact;
        $collge->gender = $request->gender;
        $collge->adhaar_card_no = $request->adhaar_no;
        $collge->dob = $request->dob;
        $image = uploadFile($request['image'], 'student');
        $collge->image = $image;
        $collge->password = Hash::make($request->password);
        $save = $collge->save();
        if ($save) {
            return redirect()->route('user.login');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }
}
