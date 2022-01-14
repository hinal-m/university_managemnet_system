<?php

namespace App\Http\Controllers\User;

use App\DataTables\AddmissionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Addmission;
use App\Models\College;
use App\Models\CollegeMerit;
use App\Models\Course;
use App\Models\MeritRound;
use App\Repositories\AddmissionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddmissionController extends Controller
{
    protected $addmission;
    public function __construct(AddmissionRepository $addmission)
    {
        $this->addmission = $addmission;
    }
    public function create()
    {
        // $merit_round = MeritRound::select('end_date')->first();
        // $toDate = Carbon::now()->format('Y-m-d');

        // if($toDate == $merit_round)
        // {
            $addmission = $this->addmission->create();
            // $college = College::all();
            return view('user.addmission.create',compact('addmission'));
        // }
        // else
        // {
        //     return 'addmission date over';
        // }
    }


    public function store(Request $request)
    {
        $addmission = $this->addmission->store($request->all());
        return response()->json(['data'=> $addmission]);
    }
}
