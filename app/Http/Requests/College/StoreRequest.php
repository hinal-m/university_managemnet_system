<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:colleges,name',
            'email' => 'required|email|unique:colleges,email',
            'address' => 'required',
            'contact' => 'required|max:10|min:10',
            'logo' => 'required',
            'password' => 'required|min:3|max:30',
            'cpassword' => 'required|min:3|max:30|same:password'
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
            'password.required' => 'Please Enter Password',
            'cpassword.required' => 'Please Enter Confirm Password',
            'cpassword.same' => 'The Confirm password And password must match.'
        ];
    }
}
