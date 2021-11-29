<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:200',
            'slug' => 'required|max:200|unique:tags,slug,' . $this->id,
            'tags' => 'required|array',
            'tags.*' => 'numeric|exists:tags,id|unique:article_tags,article_id,tag_id' . $this->id,
            'short_description' => 'required|max:300',
            'description' => 'required|max:10000',
            'images' => 'required_without:id',
            'images.*' => 'string',
        ];


    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required',
            'title.max' => 'The name title should not exceed 200 characters',
            'slug.required' => 'The slug field is required',
            'slug.max' => 'The slug field should not exceed 200 characters',
            'slug.unique' => 'This slug is existed. Please check your slug entry',
            'tags.required' => 'The tags field is required',
            'tags.array' => 'The tags field should be array',
            'tags.numeric' => 'The tags field should be a numeric value',
            'tags.exists' => 'The tags field should be exists in tag table',
            'tags.unique' => 'This tags is existed. Please check your tags entry',
            'short_description.required' => 'The short description field is required',
            'short_description.max' => 'The short description field should not exceed 300 characters',
            'description.required' => 'The description field is required',
            'description.max' => 'The description field should not exceed 10000 characters',
            'images.required_without' => 'The photo field is required',
            'images.string' => 'The photo field is string data type',

        ];

    }
}
