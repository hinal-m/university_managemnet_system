<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'college_id.*' =>'required|not_in:0',
            'course_id' =>'required|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'college_id.required' => 'Please select College',
            'merit_round_id.required' => 'Please Select Round No.',
            'course_id.required' => 'Please Select Course',
        ];
    }
}
