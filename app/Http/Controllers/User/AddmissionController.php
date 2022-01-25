<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdmissionRequest;
use App\Models\MeritRound;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Repositories\AddmissionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddmissionController extends Controller
{
    protected $addmission;
    public function __construct(AddmissionRepository $addmission)
    {
        $this->addmission = $addmission;
    }
    public function create()
    {
        $subjects = Subject::with('userStudentMark:id,subject_id,obtain_mark')->get();
        $student_mark = StudentMark::where('user_id',Auth::guard('user')->user()->id)->get();
        $toDate = Carbon::now()->format('Y-m-d');
        dd(MeritRound::all());
        $round= MeritRound::where('status','1')->where('end_date','>=',$toDate)->get()->toArray();
        dd($round);
        $addmission = $this->addmission->create();
        return view('User.addmission.create',compact(['addmission','round','toDate','subjects','student_mark']));
    }


    public function store(AdmissionRequest $request)
    {
        $addmission = $this->addmission->store($request->all());
        return response()->json(['data'=> $addmission]);
    }


}
