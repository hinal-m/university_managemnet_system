<?php

namespace App\Http\Controllers\User;

use App\DataTables\StudentMarkDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Repositories\StudentMarkRepository;
use Illuminate\Http\Request;

class StudentMarkController extends Controller
{
    protected $student_mark;
    public function __construct(StudentMarkRepository $student_mark)
    {
        $this->student_mark = $student_mark;
    }
    public function index(StudentMarkDataTable $dataTable)
    {
        return $dataTable->render('user.marks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student_mark = Subject::get();
        return view('User.marks.create',compact('student_mark'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $student_mark = $this->student_mark->store($request->all());
        return response()->json(['data' => $student_mark]);
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
        //
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
        //
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
