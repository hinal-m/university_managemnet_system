<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;

class CollegeCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [




            'course_id' => 'required|not_in:0|unique:college_courses,course_id,NULL,id',
            'reserved_seat' => 'required|numeric',
            'merit_seat' => 'required|numeric',

        ];
    }
    public function messages()
    {
        return [
            'course_id.required' => 'Please select Course',
            'course_id.unique' => ' College Course Has Been Already Taken',
            'reserved_seat.required' => 'Please Enter ReservedSeat No',
            'reserved_seat.numeric' => 'Please Enter Only Number',
            'merit_seat.required' => 'Please Enter Merit Seat No',
            'merit_seat.numeric' => 'Please Enter Only Number',
        ];
    }
}
