<?php

namespace App\Http\Controllers\User;

use App\DataTables\AddmissionDataTable;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Repositories\AddmissionRepository;
use Illuminate\Http\Request;

class AddmissionController extends Controller
{
    protected $addmission;
    public function __construct(AddmissionRepository $addmission)
    {
        $this->addmission = $addmission;
    }
    public function index(AddmissionDataTable $dataTable)
    {
        return $dataTable->render('user.addmission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $college = College::get();
        return view('user.addmission.create',compact('college'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
