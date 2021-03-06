<?php

namespace App\Http\Controllers\College;

use App\DataTables\CollegeCourseDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\College\CollegeCourseRequest;
use App\Models\CollegeCourse;
use App\Models\Course;
use App\Repositories\CollegeCourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollegeCourseController extends Controller
{
    protected $college_course;
    public function __construct(CollegeCourseRepository $college_course)
    {
        $this->college_course = $college_course;
    }
    public function index(CollegeCourseDataTable $dataTable)
    {
        return $dataTable->render('College.Course.index');
    }

    public function create()
    {
        $college_course = $this->college_course->create();
        return view('College.Course.create',compact('college_course'));

    }


    public function store(CollegeCourseRequest $request)
    {
       
        $course_repeat = CollegeCourse::where('college_id', Auth::guard('college')->user()->id)->where('course_id', $request->course_id)->first();

        if(isset($course_repeat)){
            return response()->json(['status' => 1]);
        }else{
            $college_course = $this->college_course->store($request->all());
            return response()->json(['data' => $college_course,'status'=> 2]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $college_course = CollegeCourse::find($id);
        $course = Course::get();
        return view('College.Course.edit', compact('college_course','course'));
    }

    public function update(Request $request, $id)
    {
        $college_course = $this->college_course->update($request->all());
        return response()->json(['data' => $college_course]);
    }

    public function destroy(Request $request)
    {
        $college_course = $this->college_course->delete($request->all());
        return response()->json(['data' => $college_course]);
    }
}
