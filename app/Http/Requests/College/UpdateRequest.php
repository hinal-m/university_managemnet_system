<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->id;
        return [
            'name' => 'required',
            'email' => 'required|email|unique:colleges,email,'.$id,
            'address' => 'required',
            'contact' => 'required|max:10|min:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'address.required' => 'Please Enter Address',
            'email.required' => 'Please Enter Email',
            'contact.required' => 'Please Enter Mobile No',
            'logo.required' => 'Please Select Logo',
        ];
    }
}
