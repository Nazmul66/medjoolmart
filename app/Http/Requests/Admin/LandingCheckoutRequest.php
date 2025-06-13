<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LandingCheckoutRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            // 'email'     => ['nullable','email', 'max:255'],
            'phone'     => ['required', 'regex:/^0\d{10}$/'],
            'address'   => ['required', 'string', 'max: 412'],
        ];
    }


    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter your full name. This field is required.',
            'full_name.max' => 'The full name may not exceed 255 characters.',
            // 'email.email' => 'Please enter a valid email address.',
            // 'email.max' => 'The email address may not exceed 255 characters.',
            'phone.required' => 'The phone number field is required. Please provide a valid number.',
            'phone.regex' => 'The phone number must start with 0 and consist of exactly 11 digits.',
            'city.required' => 'The city field is required. Please specify your city.',
            'address.required' => 'The address field is required. Please provide a valid address.',
            'address.max' => 'The address may not exceed 412 characters.',
        ];
    }
}
