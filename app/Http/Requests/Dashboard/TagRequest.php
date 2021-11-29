<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => 'required|max:150',
            'slug' => 'required|max:200|unique:tags,slug,' . $this->id
        ];


    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'name.max' => 'The name field should not exceed 150 characters',
            'slug.required' => 'The slug field is required',
            'slug.max' => 'The slug field should not exceed 200 characters',
            'slug.unique' => 'This slug is existed. Please check your slug entry',

        ];

    }
}
