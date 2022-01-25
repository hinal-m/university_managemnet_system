<?php

namespace App\Http\Controllers\University;

use App\DataTables\CollegeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\College\StoreRequest;
use App\Http\Requests\College\UpdateRequest;
use App\Models\College;
use App\Repositories\CollegeRepository;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    protected $college;
    public function __construct(CollegeRepository $college)
    {
        $this->college = $college;
    }

    public function index(CollegeDataTable $dataTable)
    {
        return $dataTable->render('university.college.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('University.College.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $college = $this->college->store($request->all());
        return response()->json(['data' => $college]);
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
        $college = College::find($id);
        return view('university.college.edit', compact('college'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $college = $this->college->update($request->all());
        return response()->json(['data' => $college]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = $this->college->delete($request->all());
        return response()->json(['data' => $category]);
    }

    public function status(Request $request)
    {
        $id = $request['id'];
        $college = College::find($id);

        if ($college->status == "1") {
            $college->status = "0";
        } else {
            $college->status = "1";
        }
        $college->save();
        return response()->json(['data' => $college]);
    }
}
