<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'image' => 'required',
                'address' => 'required',
                'adhaar_no' => 'required',
                'contact' => 'required|digits:10',
                'gender' => 'required|in:m,f,o',
                'dob' => 'required',
                'password' => 'required|min:3|max:30',
                'confirm_password' => 'required|min:3|max:30|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'image.required' => 'Please Select Image',
            'address.required' => 'Please Enter address',
            'adhaar_no.required' => 'Please Enter Adhaar Card No',
            'email.required' => 'Please Enter Email',
            'contact.required' => 'Please Enter Mobile No',
            'gender.required' => 'Please select Gender',
            'dob.required' => 'Please select Birth date',
            'password.required' => 'Please Enter Password',
            'confirm_password.required' => 'Please Enter Confirm Password',
            'confirm_password.same' => 'The Confirm password And password must match.'
        ];
    }
}
