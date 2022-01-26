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
use Illuminate\Support\Str;
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
        $addmission = Addmission::with(['meritRound','course','user'])->where('user_id', Auth::guard('user')->user()->id)->first();
        // dd($addmission);

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
        for($i=0;$i<count($data['id']);$i++)
        {
            StudentMark::updateOrCreate([
                'subject_id'=> $data['id'][$i],
                'user_id' => Auth::guard('user')->user()->id,
            ],[
                'subject_id'=> $data['id'][$i],
                'user_id' => Auth::guard('user')->user()->id,
                'total_mark'=>'100',
                'obtain_mark'=>$data['mark'][$i]
            ]);
        }
        $student_mark = StudentMark::with('commonSetting')->where('user_id',Auth::guard('user')->user()->id)->get();

        $total_common_setting_mark = CommonSetting::sum('marks');
        // dd($total_common_setting_mark);
        $total_marks=0;
        // dd($student_mark);
        foreach($student_mark as $value)
        {
            // dd($value->obtain_mark);
            $obtain_mark =( $value->obtain_mark * $value->commonSetting->marks )/100;

            $total_marks += $obtain_mark;
        }
        $merit = ($total_marks / $total_common_setting_mark) * 100;

        $course_name = Course::where('id', $data['course_id'])->pluck('name')->first();
        // $toDate = Carbon::now()->format('Y-m-d');

        // $round = MeritRound::where('course_id',$data['course_id'])->where('status','1')->where('merit_result_declare_date', '=', $toDate)->latest()->pluck('round_no')->first();
        // dd($round);

        $addmission = Addmission::updateOrCreate([
            'user_id' => Auth::guard('user')->user()->id,
        ],[
            'college_id'=> (array)$data['college_id'],
            'user_id' => Auth::guard('user')->user()->id,
            'merit' => round($merit,2),
            'course_id'=> $data['course_id'],
            'merit_round_id'=>1,
            'addmission_date'=>Carbon::now()->format('Y-m-d'),
            'addmission_code'=>Str::upper($course_name).date('ymd').Auth::guard('user')->user()->id,
            'status' => '3'
        ]);

        return $addmission;
    }

    // public function reservedConfirm(array $data)
    // {
    //     dd($data);
    // }
}
