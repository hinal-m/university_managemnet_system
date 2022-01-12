<?php

namespace App\Repositories;

use App\Interfaces\AddmissionInterface;
use App\Models\Addmission;
use App\Models\CollegeCourse;
use App\Models\CollegeMerit;
use App\Models\Course;
use App\Models\MeritRound;
use Illuminate\Support\Facades\Auth;

class AddmissionRepository implements AddmissionInterface
{
    public function all()
    {
        return Addmission::all();
    }

    public function create()
    {
        $college_course = CollegeCourse::where('College_id', Auth::guard('college')->user()->id)->get();
        $merit_round = MeritRound::select('round_no')->get();
        $array =  [
            'college_course' => $college_course,
            'merit_round' => $merit_round
        ];
        return $array;
    }

    public function store(array $data)
    {
        // dd($data);
        $college_merit = new CollegeMerit;
        $college_merit->college_id = Auth::guard('college')->user()->id;
        $college_merit->merit_round_id = $data['round_no'];
        $college_merit->course_id = $data['course_id'];
        $college_merit->merit = $data['merit'];
        // dd($college_merit);
        $save = $college_merit->save();
        return $save;
    }

    public function delete(array $data)
    {
        $college_merit = CollegeMerit::find($data['id']);
        $college_merit->delete();
        return $college_merit;
    }
}
