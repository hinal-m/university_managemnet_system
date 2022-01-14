<?php

namespace App\Http\Controllers\University;

use App\DataTables\AddmissionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Addmission;
use Illuminate\Http\Request;

class AddmissionController extends Controller
{
    public function index(AddmissionDataTable $dataTable )
    {
        $addmission = Addmission::all();
        return $dataTable->render('University.admission.index');
    }
}
