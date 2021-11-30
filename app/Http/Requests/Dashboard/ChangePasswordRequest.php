<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|confirmed|min:4',
        ];
    }

    public function messages()
    {
        return[
            'old_password.required' => 'The old password field is required',
            'password.required' => 'The password field is required',
            'password.min' => 'The password must be at least 4 characters long',
            'password.confirmed' => 'The password does not match, please check it',
        ];

    }
}
