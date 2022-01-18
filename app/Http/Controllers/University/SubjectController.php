<?php

namespace App\Http\Controllers\University;

use App\DataTables\SubjectDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(SubjectDataTable $dataTable)
    {
        $subject = Subject::all();
        return $dataTable->render('University.Subject.index');
    }

}
