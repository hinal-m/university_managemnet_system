<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\AdmissionConfirmMail;
use App\Models\Addmission;
use App\Models\AddmissionConfirmation;
use App\Models\College;
use App\Models\CollegeCourse;
use App\Models\CollegeMerit;
use App\Models\MeritRound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('User.layouts.content');
    }


    //User Message
    public function index()
    {
        $toDate = Carbon::now()->format('Y-m-d');
        $declare_date = MeritRound::where('merit_result_declare_date', '=', $toDate)->get()->toArray();
        $admission = Addmission::where('user_id', Auth::guard('user')->user()->id)->first();
        $admission_college = Addmission::where('user_id', Auth::guard('user')->user()->id)->pluck('college_id')->toArray();
        $collegemerit = [];
        $message = '';
        if (!empty($admission_college)) {

            $first =  reset($admission_college[0]);

            $collegeInfo = CollegeMerit::whereIn('college_id', $admission_college[0])->where('merit', '<=', $admission->merit)->get();

            if (count($collegeInfo) == 0) {

                // $collegemerit = college::where('id', $first)->first(['id', 'name']);
                $message = "Sorry !! You Not Selected || For This Round";
            } else {
                $collegemerit = college::where('id', $collegeInfo[0]->college_id)->first();
            }

            return view('User.layouts.content', compact('declare_date', 'collegemerit', 'message','admission'));
        }
        return view('User.layouts.content', compact('declare_date'));
    }


    //Confirm Admission
    public function confirm(Request $request)
    {
        $userInfo = Addmission::where('user_id', Auth::user()->id)->first();
        $userInfo->save();
        $collegeCourse = CollegeCourse::where('college_id', $request->id)->where('course_id', $userInfo->course_id)->select('merit_seat')->first();
        $addmissionConfirmation = AddmissionConfirmation::where('confirm_college_id', $request->college_id)->where('confirm_round_id', $request->merit_round_id)->where('confirmation_type', 'M')->get();
        if ($collegeCourse->merit_seat >= count($addmissionConfirmation)) {

            $user_id = User::where('id', $userInfo->user_id)->first();

            $admission_confirm = AddmissionConfirmation::create([
                'addmission_id' => $userInfo->id,
                'confirm_college_id' => $request['id'],
                'confirm_round_id' => $userInfo->merit_round_id,
                'confirm_merit' => $userInfo->merit,
                'confirmation_type' => 'M',
            ]);

            Mail::to($user_id->email)->send(new AdmissionConfirmMail($admission_confirm));

            Addmission::where('id', $userInfo->id)->update([
                'status' => '1'
            ]);
            MeritRound::where('id', $userInfo->merit_round_id)->update([
                'status' => '0'
            ]);
        } else {

        }

        return response()->json(['data' => $admission_confirm]);
    }

    //change password
    public function showChangePasswordGet()
    {
        return view('User.Auth.ChangePassword');
    }
    public function changePasswordPosts(Request $request)
    {
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
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }

    //Profile

    public function showProfile($id)
    {
        $user = User::find($id);
        return view('User.Auth.Profile', compact('user'));
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
        return response()->json(['data' => $save]);
    }
}
