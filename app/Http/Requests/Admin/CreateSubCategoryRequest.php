<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubCategoryRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'subcategory_name' => ['required', 'unique:subcategories', 'max:255'],
            'subcategory_img' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }


    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select category name',
            'subcategory_name.required' => 'Please fill up subCategory name',
            'subcategory_name.max' => 'Character might be 255 words',
            'subcategory_name.unique' => 'Character might be unique',
            'subcategory_img.image' => 'The uploaded file must be an image',
            'subcategory_img.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
            'subcategory_img.required' => 'Image is required',
        ];
    }
}
