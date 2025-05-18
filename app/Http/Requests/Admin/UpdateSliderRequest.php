<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
        $id = $this->route('slider');

        return [
            'title' => ['required', 'unique:sliders,title,'. $id, 'max:200' ],
            'slider_image' => ['image', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096' ],
        ];
    }


    public function messages(): array
    {
        return [
            'title.required' => 'Please fill up title name',
            'title.max' => 'Character might be 255 words',
            'slider_image.image' => 'The uploaded file must be an image',
            'slider_image.mimes' => 'The image must be a file of type: ( png, jpg, jpeg, webp )',
        ];
    }
}
