<?php

namespace App\Http\Controllers\College;

use App\DataTables\AdmissionCotaDataTable;
use App\DataTables\CollegeAdmissionDataTable;
use App\Exports\AdmissionMeritExport;
use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\AddmissionConfirmation;
use App\Models\College;
use App\Models\CollegeMerit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $meritAdmission = AddmissionConfirmation::where('confirm_college_id', Auth::guard('college')->user()->id)->count();

        return view('College.layouts.content', compact('meritAdmission'));
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
        return view('College.Auth.Profile', compact('college'));
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
        return response()->json(['data' => $save]);
    }

    public function index(CollegeAdmissionDataTable $dataTable)
    {
        //   dd(1);
        $addmission = AddmissionConfirmation::all();
        // dd($addmission);
        return $dataTable->render('College.admission.index');
    }

    public function meritexport()
    {
        return Excel::download(new AdmissionMeritExport, 'MeritAddmision.xlsx');
    }
    public function reservePdf()
    {
        $college_merit = CollegeMerit::where('college_id', Auth::guard('college')->user()->id)->first();
        $college_id = Auth::guard('college')->user()->id;
        if ($college_merit) {
            $reserveAdmission = Addmission::where('merit', '<=', $college_merit->merit)
                ->where('college_id', 'like', '%"' . $college_id . '"%')
                ->where('status', '!=', '1')
                ->newQuery();
        } else {
            $reserveAdmission = Addmission::where('id', -1)->newQuery();
        }
        // dd($reserveAdmission);
        // dd($meritAdmission);
        // $addmission = Addmission::where('id',$meritAdmission->addmission_id)->pluck('addmission_code')->first();
        // dd($meritAdmission);
        $pdf = PDf::loadview('College.admission.reservePdf', compact('reserveAdmission'));
        return $pdf->stream('document.pdf');
    }

    public function cotaAdmission(AdmissionCotaDataTable $dataTable)
    {
        $addmission = Addmission::all();
        return $dataTable->render('College.admission.list');
    }

    public function reservedConfirm(Request $request)
    {
        //   dd($request->all());
        $userInfo = Addmission::where('id', $request->id)->first();
        // dd($userInfo);


        $admission_confirm = AddmissionConfirmation::create([
            'addmission_id' => $userInfo->id,
            'confirm_college_id' => Auth::guard('college')->user()->id,
            'confirm_round_id' => $userInfo->merit_round_id,
            'confirm_merit' => $userInfo->merit,
            'confirmation_type' => 'R',
        ]);
        Addmission::where('id', $userInfo->id)->update([
            'status' => '1'
        ]);
        return response()->json(['data' => $admission_confirm]);
    }
}
