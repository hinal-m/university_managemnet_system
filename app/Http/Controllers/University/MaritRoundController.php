<?php

namespace App\Http\Controllers\University;

use App\DataTables\MeritRoundDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\University\MeritRoundRequest;
use App\Http\Requests\University\MeritRoundUpdateRequest;
use App\Models\Course;
use App\Models\MeritRound;
use App\Repositories\MaritRoundRepository;
use Illuminate\Http\Request;

class MaritRoundController extends Controller
{
    protected $marit_round;
    public function __construct(MaritRoundRepository $marit_round)
    {
        $this->marit_round = $marit_round;
    }
    public function index(MeritRoundDataTable $dataTable)
    {
        return $dataTable->render('University.marit.index');
    }


    public function create()
    {
        $course = $this->marit_round->create();
        return view('University.marit.create',compact('course'));

    }


    public function store(MeritRoundRequest $request)
    {
        $marit_round = $this->marit_round->store($request->all());
        return response()->json(['data' => $marit_round]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $marit_round = MeritRound::find($id);
        $course = Course::get();
        return view('University.marit.edit', compact('marit_round','course'));
    }


    public function update(MeritRoundUpdateRequest $request, $id)
    {
        $marit_round = $this->marit_round->update($request->all());
        return response()->json(['data' => $marit_round]);
    }


    public function destroy(Request $request)
    {
        $marit_round = $this->marit_round->delete($request->all());
        return response()->json(['data' => $marit_round]);
    }

    public function status(Request $request)
    {
        $id = $request['id'];
        $marit_round = MeritRound::find($id);

        if ($marit_round->status == "1") {
            $marit_round->status = "0";
        } else {
            $marit_round->status = "1";
        }
        $marit_round->save();
        return response()->json(['data' => $marit_round]);
    }
}
