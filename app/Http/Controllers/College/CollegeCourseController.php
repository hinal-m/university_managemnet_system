<?php

namespace App\Http\Controllers\College;

use App\DataTables\CollegeCourseDataTable;
use App\Http\Controllers\Controller;
use App\Models\CollegeCourse;
use App\Models\Course;
use App\Repositories\CollegeCourseRepository;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $college_course = $this->college_course->create();
        return view('College.Course.create',compact('college_course'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $college_course = $this->college_course->store($request->all());
        return response()->json(['data' => $college_course]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $college_course = CollegeCourse::find($id);
        // dd($college_course);
        $course = Course::get();
        return view('College.Course.edit', compact('college_course','course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $college_course = $this->college_course->update($request->all());
        return response()->json(['data' => $college_course]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
