<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
        $id = $this->route('brand');

        return [
            'brand_name' => ['required', 'unique:brands,brand_name,'. $id , 'max:255'],
            'image' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ];
    }


    public function messages(): array
    {
        return [
            'brand_name.required' => 'Please fill up brand name',
            'brand_name.max' => 'Character might be 255 word',
            'brand_name.unique' => 'Character might be unique',
            'image.image' => 'The uploaded file must be an image',
            'image.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
