<?php

namespace App\Repositories;

use App\Interfaces\CollegeCourseInterface;
use App\Models\College;
use App\Models\CollegeCourse;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CollegeCourseRepository implements CollegeCourseInterface
{
    public function all()
    {
        return CollegeCourse::all();
    }

    public function create()
    {
        $course = Course::get();
        return $course;
    }

    public function store(array $data)
    {
        $college = new CollegeCourse;
        $college->college_id = Auth::user('college')->id;
        $college->course_id = $data['course_id'];
        $college->merit_seat = $data['merit_seat'];
        $college->reserved_seat = $data['reserved_seat'];
        $seat_no = $data['merit_seat'] + $data['reserved_seat'];
        $college->seat_no = $seat_no;
        $save = $college->save();
        return $save;
    }

    public function update(array $data)
    {
        $college = CollegeCourse::find($data['id']);
        $college->course_id = $data['course_id'];
        $college->merit_seat = $data['merit_seat'];
        $college->reserved_seat = $data['reserved_seat'];
        $seat_no = $data['merit_seat'] + $data['reserved_seat'];
        $college->seat_no = $seat_no;
        $save = $college->save();
        return $save;
    }

    public function delete(array $data)
    {
        $college_course = CollegeCourse::find($data['id']);
        $college_course->delete();
        return $college_course;
    }
}
