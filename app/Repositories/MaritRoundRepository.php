<?php

namespace App\Repositories;

use App\Interfaces\MaritRoundInterface;
use App\Models\CollegeCourse;
use App\Models\Course;
use App\Models\MeritRound;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MaritRoundRepository implements MaritRoundInterface
{
    public function all()
    {
        return MeritRound::all();
    }

    public function create()
    {
        $marit_round = Course::get();
        return $marit_round;
    }

    public function store(array $data)
    {
        $marit_round = new MeritRound;
        $marit_round->round_no = $data['round_no'];
        $marit_round->course_id = $data['course_id'];
        $marit_round->start_date = $data['start_date'];
        $marit_round->end_date = $data['end_date'];
        $marit_round->merit_result_declare_date = $data['marit_result'];
        $save = $marit_round->save();
        return $save;
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
