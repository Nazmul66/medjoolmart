<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
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
        $id = $this->route('subcategory');

        return [
            'category_id' => ['numeric'],
            'subcategory_name' => ['required', 'max:255', 'unique:subcategories,subcategory_name,'. $id ],
            'subcategory_img' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }


    public function messages(): array
    {
        return [
            'subcategory_name.required' => 'Please fill up subCategory name',
            'subcategory_name.max' => 'Character might be 255 words',
            'subcategory_img.image' => 'The uploaded file must be an image',
            'subcategory_img.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
            'subcategory_name.unique' => 'Character might be unique',
        ];
    }
}
