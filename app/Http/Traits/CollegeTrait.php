<?php
namespace App\Http\Traits;

use App\Models\College;

trait CollegeTrait {
    public function collegeAll() {
        // Get all the college from the college Table.
        $college = College::all();

        return $college;
    }
}