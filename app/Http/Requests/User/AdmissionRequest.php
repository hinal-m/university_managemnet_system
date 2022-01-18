<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
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
