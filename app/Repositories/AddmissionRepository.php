<?php

namespace App\Repositories;

use App\Interfaces\AddmissionInterface;
use App\Models\Addmission;
use App\Models\College;
use App\Models\CollegeCourse;
use App\Models\CollegeMerit;
use App\Models\CommonSetting;
use App\Models\Course;
use App\Models\MeritRound;
use App\Models\StudentMark;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AddmissionRepository implements AddmissionInterface
{
    public function all()
    {
        return Addmission::all();
    }

    public function create()
    {

        $college = College::all();
        $merit_round = MeritRound::all();
        $course = Course::all();
        $addmission = Addmission::with(['meritRound', 'course'])->where('user_id', Auth::guard('user')->user()->id)->first();

        $array =  [
            'college' => $college,
            'merit_round' => $merit_round,
            'course' => $course,
            'addmission' => $addmission,
        ];
        return $array;
    }

    public function store(array $data)
    {
    //    dd($data);
        $student_mark = StudentMark::with('commonSetting')->where('user_id',Auth::guard('user')->user()->id)->get();
        $total_common_setting_mark = CommonSetting::sum('marks');
        $total_marks=0;
        foreach($student_mark as $value)
        {
            $obtain_mark = $value->obtain_mark * $value->commonSetting->marks /100;
            $total_marks += $obtain_mark;
        }
        $merit = ($total_marks / $total_common_setting_mark) * 100;

        $course_name = Course::where('id', $data['course_id'])->pluck('name')->first();
        // $addmission = new Addmission;
        // $addmission->user_id = Auth::guard('user')->user()->id;
        // $addmission->college_id = implode(',',$data['college_id']);
        // $addmission->course_id = $data['course_id'];
        // $addmission->merit_round_id = $data['merit_round_id'];
        // $addmission->merit = $merit;
        // $addmission->addmission_date = date('y/m/d');
        // $addmission->addmission_code = $course_name.date('ymd').Auth::guard('user')->user()->id;
        // $addmission->status = '1';
        // $save = $addmission->save();
        // return $save;

        StudentMark::updateOrCreate([
            'user_id' => Auth::guard('user')->user()->id,
        ],[
            'college_id'=> implode(',',$data['college_id']),
            'user_id' => Auth::guard('user')->user()->id,
            'course_id'=> $data['course_id'],
            'merit_round_id'=>$data['merit_round_id'],
            'merit' => $merit,
            'addmission_date'=>date('y/m/d'),
            'addmission_code'=>$course_name.date('ymd').Auth::guard('user')->user()->id,
            'status' => '1'
        ]);
    }
}
