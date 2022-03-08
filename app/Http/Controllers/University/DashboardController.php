<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\College;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('University.layouts.content');
    }

    public function index()
    {
        $college = College::all()->count();
        $student = User::all()->count();
        $admission = Addmission::all()->count();
        return view('University.layouts.content',compact(['college','student','admission']));
    }

    public function chart()
    {
        // dd(1);
        $college = College::all()->count();
        $student = User::all()->count();
        $admission = Addmission::all()->count();
        $result = array(
            'college' => $college,
            'student' => $student,
            'admission' => $admission
        );
        // dd($result);
        return response()->json(['data'=> $result]);
    }

    //change password
    public function showChangePasswordGet()
    {
        return view('University.Auth.ChnagePassword');
    }
    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new-password'
        ]);

        //Change Password

        $seller = University::where('id', Auth::user()->id)->first();
        $seller->password = Hash::make($request->get('new-password'));
        $seller->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }
}
