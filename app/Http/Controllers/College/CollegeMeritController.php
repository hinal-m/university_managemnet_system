<?php

namespace App\Http\Controllers\College;

use App\DataTables\CollegeMeritDataTable;
use App\Http\Controllers\Controller;
use App\Models\CollegeCourse;
use App\Models\CollegeMerit;
use App\Models\MeritRound;
use App\Repositories\CollegeMeritRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollegeMeritController extends Controller
{
    protected $college_merit;
    public function __construct(CollegeMeritRepository $college_merit)
    {
        $this->college_merit = $college_merit;
    }
    public function index(CollegeMeritDataTable $dataTable)
    {
        return $dataTable->render('College.merit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $college_merit = $this->college_merit->create();
        return view('College.merit.create',compact('college_merit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $college_merit = $this->college_merit->store($request->all());
        return response()->json(['data' => $college_merit]);
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
        $college_merit = CollegeMerit::find($id);

        $college_course = CollegeCourse::where('College_id', Auth::guard('college')->user()->id)->get();

        return view('College.merit.edit',compact('college_merit','college_course'));


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
    public function destroy(Request $request)
    {
        $college_merit = $this->college_merit->delete($request->all());
        return response()->json(['data' => $college_merit]);
    }

    public function getRound(Request $request)
    {
        // dd($request['id']);
        $data = MeritRound::select('round_no')->where('course_id',$request['id'])->get();
        // dd($data);
        return response()->json([
            'data' => $data
        ]);
    }
}
