<?php

namespace App\Repositories;

use App\Interfaces\StudentMarksInterface;
use App\Models\Course;
use App\Models\MeritRound;
use App\Models\StudentMark;
use App\Models\StudentMarks;

class StudentMarkRepository implements StudentMarksInterface
{
    public function all()
    {
        return StudentMark::all();
    }

    public function create()
    {
        $marit_round = Course::get();
        return $marit_round;
    }

    public function store(array $data)
    {
        // dd(count($data['id']));

        for($i=1;$i<=count($data['id']);$i++)
        {
            StudentMark::create([
                'subject_id'=>$data['id'][$i],
                'total_mark'=>'100',
                'obtain_mark'=>$data['mark'][$i]
            ]);
        }
    }

    public function update(array $data)
    {
        $marit_round = MeritRound::find($data['id']);
        $marit_round->round_no = $data['round_no'];
        $marit_round->course_id = $data['course_id'];
        $marit_round->start_date = $data['start_date'];
        $marit_round->end_date = $data['end_date'];
        $marit_round->merit_result_declare_date = $data['marit_result'];
        $save = $marit_round->save();
        return $save;
    }

    public function delete(array $data)
    {
        $marit_round = MeritRound::find($data['id']);
        $marit_round->delete();
        return $marit_round;
    }
}
