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
        $college->seat_no = $data['seat_no'];
        $college->reserved_seat = $data['reserved_seat'];
        $college->merit_seat = $data['merit_seat'];
        $save = $college->save();
        return $save;
    }

    public function update(array $data)
    {
        $college = CollegeCourse::find($data['id']);
        $college->course_id = $data['course_id'];
        $college->seat_no = $data['seat_no'];
        $college->reserved_seat = $data['reserved_seat'];
        $college->merit_seat = $data['merit_seat'];
        $save = $college->save();
        return $save;
    }

    public function delete(array $data)
    {
        $category = College::find($data['id']);
        $category->delete();
        return $category;
    }
}
