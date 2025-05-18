<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildCategoryRequest extends FormRequest
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
        $id = $this->route('childCategory');

        return [
            'category_id' => ['numeric'],
            'subCategory_id' => ['numeric'],
            'name' => ['required', 'max:255', 'unique:child_categories,name,'. $id ],
            'img' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please fill up childCategory name',
            'name.max' => 'Character might be 255 word',
            'name.unique' => 'Character might be unique',
            'img.image' => 'The uploaded file must be an image',
            'img.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
