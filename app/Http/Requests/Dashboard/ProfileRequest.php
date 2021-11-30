<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'. $this -> id,
            'image' => 'required_without:id|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'The name field is required',
            'email.required' => 'The email field is required',
            'email.email' => 'Please Check The Email Formula Entry',
            'email.unique' => 'This Email Is Existed. Please Check Your Email Entry',
            'image.required_without' => 'The image field is required',
            'image.mimes' => 'The photo should be in jpg, jpeg, png format',
        ];

    }
}
