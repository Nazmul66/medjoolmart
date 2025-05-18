<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandRequest extends FormRequest
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
            'brand_name' => ['required', 'unique:brands,brand_name', 'max:255'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }


    public function messages(): array
    {
        return [
            'brand_name.required' => 'Please fill up brand name',
            'brand_name.max' => 'Character might be 255',
            'brand_name.unique' => 'Character might be unique',
            'image.required' => 'Brand logo is required',
            'image.image' => 'The uploaded file must be an image',
            'image.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
