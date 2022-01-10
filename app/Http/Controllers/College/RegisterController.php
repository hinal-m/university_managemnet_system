<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Http\Requests\College\StoreRequest;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerFormShow()
    {
        // dd(1);
        return view('College.Auth.register');
    }

    public function register(StoreRequest $request)
    {
        // dd(1);
        $collge = new College();
        $collge->name = $request->name;
        $collge->email = $request->email;
        $collge->address = $request->address;
        $collge->contact_no = $request->contact;
        $collge->status = '1';
        $logo = uploadFile($request['logo'], 'college');
        $collge->logo = $logo;
        $collge->password = Hash::make($request->password);
        $save = $collge->save();
        if ($save) {
            return redirect()->route('college.college.login');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }
}
