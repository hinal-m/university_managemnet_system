<?php

namespace App\Http\Controllers\User;

use App\DataTables\StudentMarkDataTable;
use App\Http\Controllers\Controller;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Repositories\StudentMarkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMarkController extends Controller
{
    protected $student_mark;
    public function __construct(StudentMarkRepository $student_mark)
    {
        $this->student_mark = $student_mark;
    }
    public function create()
    {

        $subjects = Subject::with('userStudentMark:id,subject_id,obtain_mark')->get();
        $student_mark = StudentMark::where('user_id',Auth::guard('user')->user()->id)->get();
        return view('User.marks.create',compact('student_mark','subjects'));
    }

    public function store(Request $request)
    {
        $student_mark = $this->student_mark->store($request->all());
        return response()->json(['data' => $student_mark]);
    }
}
