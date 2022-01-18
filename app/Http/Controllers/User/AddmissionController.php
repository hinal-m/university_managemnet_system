<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdmissionRequest;
use App\Models\MeritRound;
use App\Repositories\AddmissionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AddmissionController extends Controller
{
    protected $addmission;
    public function __construct(AddmissionRepository $addmission)
    {
        $this->addmission = $addmission;
    }
    public function create()
    {
        $toDate = Carbon::now()->format('Y-m-d');
        $round= MeritRound::where('start_date','<=',$toDate)->where('end_date','>=',$toDate)->get()->toArray();
            $addmission = $this->addmission->create();
            return view('user.addmission.create',compact(['addmission','round','toDate']));
    }


    public function store(AdmissionRequest $request)
    {
        $addmission = $this->addmission->store($request->all());
        // dd($addmission);
        return response()->json(['data'=> $addmission]);
    }
}
