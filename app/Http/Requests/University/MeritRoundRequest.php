<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class MeritRoundRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'round_no' =>'required|max:3|numeric|unique:merit_rounds,round_no,NULL,id',
            'course_id' =>'required|not_in:0',
            'start_date' =>'required',
            'end_date' =>'required',
            'marit_result' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Please select Course',
            'round_no.required' => 'Please Enter Seat No',
            'round_no.unique' => 'University round Has Been Already Taken',
            'start_date.required' => 'Please Select Start Date',
            'end_date.required' => 'Please Select End Date',
            'marit_result.required' => 'Please Select Declare Date',
            'round_no.numeric' => 'Please Enter Only Number',
        ];
    }
}
