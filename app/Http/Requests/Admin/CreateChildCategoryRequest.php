<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateChildCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;  // By Default false but make this true
        return true; // Set to true to allow all authorized users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'numeric'],
            'subCategory_id' => ['required', 'numeric'],
            'name' => ['required', 'unique:child_categories', 'max:255'],
            'img' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select category name',
            'subCategory_id.required' => 'Please select subCategory name',
            'name.required' => 'Please fill up childCategory name',
            'name.max' => 'Character might be 255 word',
            'name.unique' => 'Character might be unique',
            'img.required' => 'Image is required',
            'img.image' => 'The uploaded file must be an image',
            'img.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
