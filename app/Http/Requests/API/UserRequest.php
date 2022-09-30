<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:70',
            'email'=>'required|email|unique:users,email',
            'profile'=>'sometimes',
            'password'=> [
            'required', 
            'min:6',       
            ],
            'cpassword' => 'required|same:password',
        ];
    }






    public function messages()
    {
        return [
            'name.required'=> 'username is required',
            'name.max'=> 'Username is too long',
            'email.required'=>'Email is required',
            'email.unique'=>'The email has already been taken',
            'email.email'=>'Not a valid email',
            'password.required'=> 'Password is required',
            'password.regex'=> 'Password is must contain at least one lowercase letter, one uppercase, one digit and a special character',
            'password.min'=>'Password must be at least character',
            'cpassword.same' => `Password doesn't match`
        ];
    }
}
