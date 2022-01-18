<?php

namespace App\Http\Controllers\College;

use App\DataTables\AdmissionCotaDataTable;
use App\DataTables\CollegeAdmissionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('College.layouts.content');
    }

     //change password
     public function showChangePasswordGet()
     {
         return view('College.Auth.ChangePassword');
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

         $seller = College::where('id', Auth::user()->id)->first();
         $seller->password = Hash::make($request->get('new-password'));
         $seller->save();

         return redirect()->back()->with("success", "Password successfully changed!");
     }

      //Profile

      public function showProfile($id)
      {
          $college = College::find($id);
          return view('College.Auth.Profile',compact('college'));
      }

      public function editProfile(Request $request)
      {
          $college = College::find(Auth::user()->id);

          $college->name = $request->name;
          $college->email = $request['email'];
          $college->address = $request['address'];
          $college->contact_no = $request['contact'];
          if (isset($request['logo'])) {
             $image = $college->getRawOriginal('logo');
             if (file_exists(public_path('storage/college/' . $image))) {
                 @unlink(public_path('storage/college/' . $image));
             }
             $images = uploadFile($request['logo'], 'college');
             $college->logo = $images;
         } else {
             $images = $college->getRawOriginal('logo');
         }
         $save = $college->save();
         return response()->json([ 'data' => $save]);
      }

      public function index(CollegeAdmissionDataTable $dataTable)
      {
            $addmission = Addmission::all();
            return $dataTable->render('College.admission.index');
      }

      public function cotaAdmission(AdmissionCotaDataTable $dataTable)
      {
        $addmission = Addmission::all();
        return $dataTable->render('College.admission.index');
      }
}
