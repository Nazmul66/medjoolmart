<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;  // By Default false but make this true
        return true; // Set to true to allow all authorized users
    }


    public function rules(): array
    {
        return [
            'category_name' => ['required', 'unique:categories,category_name', 'max:255'],
            'category_img' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }


    public function messages(): array
    {
        return [
            'category_name.required' => 'Please fill up Category name',
            'category_name.max' => 'Character might be 255 word',
            'category_name.unique' => 'Character might be unique',
            'category_img.required' => 'Category Image is required',
            'category_img.image' => 'The uploaded file must be an image',
            'category_img.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
