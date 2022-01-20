<?php

namespace App\Exports;

use App\Models\AddmissionConfirmation;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class AdmissionMeritExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AddmissionConfirmation::where('confirm_college_id',Auth::guard('college')->user()->id)->get();
    }
}
