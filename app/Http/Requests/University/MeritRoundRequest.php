<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class MeritRoundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'round_no' =>'required|numeric',
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
            'round_no.numeric' => 'Please Enter Only Number',
        ];
    }
}
