<?php

namespace App\Repositories;

use App\Interfaces\StudentMarksInterface;
use App\Models\Course;
use App\Models\MeritRound;
use App\Models\StudentMark;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class StudentMarkRepository implements StudentMarksInterface
{
    public function all()
    {
        return StudentMark::all();
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
    }

}
