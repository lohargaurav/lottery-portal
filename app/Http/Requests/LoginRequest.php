<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request {

    public function authorize()
    {
        return true;
    }
  
    public function rules()
    {
        return [
            'username'=>'required',
            'password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Enter your username ',
            'password.required' => 'Enter your password.'
        ];
    }

}

