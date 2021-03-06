<?php

namespace App\Http\Controllers\University;

use App\DataTables\CollegeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\College\StoreRequest;
use App\Http\Requests\College\UpdateRequest;
use App\Http\Traits\CollegeTrait;
use App\Models\College;
use App\Repositories\CollegeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollegeController extends Controller
{
    protected $college;
    use CollegeTrait;
    public function __construct(CollegeRepository $college)
    {
        $this->college = $college;
    }

    public function index(CollegeDataTable $dataTable)
    {
        // $users = DB::table('colleges')
        // ->where('name', 'like', 'g%')
        //     ->selectRaw('colleges.name, count(*) name')
        //     ->groupBy('colleges.name')
        //     ->get();
        // dd($users);

    //     $products = College::select('id', 'name')
    // ->selectRaw('address - discount_price AS discount')
    // ->get();
        $college = $this->collegeAll();
        return $dataTable->render('University.College.index'); 
    }

    public function create()
    {
        return view('University.College.create');
    }

    public function store(StoreRequest $request)
    {
        $college = $this->college->store($request->all());
        return response()->json(['data' => $college]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $college = College::find($id);
        return view('University.College.edit', compact('college'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $college = $this->college->update($request->all());
        return response()->json(['data' => $college]);
    }

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
