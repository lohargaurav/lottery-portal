<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserLoginRequest extends Request {

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
			'username'=>'Required',
			'password'=>'Required|min:6',
		];
	}
	
	public function messages()
	{
		return[
		'username.required'=>'Enter User Name',
		'password.required'=>'Enter Password',
		];
	}

}
