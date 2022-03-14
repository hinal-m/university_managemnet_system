<?php

namespace App\Http\Controllers\University;

use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(StudentDataTable $dataTable)
    {
        $student = User::all();
        return $dataTable->render('University.Student.index');
    }

    public function delete(Request $request)
    {
        $category = User::find($request['id']);
        $category->delete();
        return response()->json([
            'data'=>$category
        ]);
    }
}
