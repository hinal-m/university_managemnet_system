<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('User.layouts.content');
    }

     //change password
     public function showChangePasswordGet()
     {
         return view('User.Auth.ChangePassword');
     }
     public function changePasswordPosts(Request $request)
     {
         dd(1);
         if (!(Hash::check($request->get('current-password'), Auth::user('user')->password))) {
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

         $user = User::where('id', Auth::user()->id)->first();
         dd($user);
         $user->password = Hash::make($request->get('new-password'));
         $user->save();

         return redirect()->back()->with("success", "Password successfully changed!");
     }

     //Profile

     public function showProfile($id)
     {
         $user = User::find($id);
         return view('User.Auth.Profile',compact('user'));
     }

     public function editProfile(Request $request)
     {
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request['email'];
        $user->address = $request['address'];
        $user->dob = $request['dob'];
        $user->gender = $request['gender'];
        $user->contact_no = $request['contact'];
        $user->adhaar_card_no = $request['adhaar_no'];
        if (isset($request['image'])) {
            $image = $user->getRawOriginal('image');
            if (file_exists(public_path('storage/student/' . $image))) {
                @unlink(public_path('storage/student/' . $image));
            }
            $images = uploadFile($request['image'], 'student');
            $user->image = $images;
        } else {
            $images = $user->getRawOriginal('image');
        }
        $save = $user->save();
        return response()->json([ 'data' => $save]);
     }
}
