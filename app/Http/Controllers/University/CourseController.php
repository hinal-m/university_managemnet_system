<?php

namespace App\Http\Controllers\University;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(CourseDataTable $dataTable)
    {
        $course = Course::all();
        return $dataTable->render('University.Course.index');
    }

    public function status(Request $request)
    {
        $id = $request['id'];
        $course = Course::find($id);

        if ($course->status == "1") {
            $course->status = "0";
        } else {
            $course->status = "1";
        }
        $course->save();
        return response()->json(['data' => $course]);
    }
}
