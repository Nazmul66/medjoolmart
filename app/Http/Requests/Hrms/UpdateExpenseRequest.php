<?php

namespace App\Http\Requests\Hrms;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
        $id = $this->route('expense');

        return [
            'user_id'       => ['required', 'numeric'],
            'item_name'     => ['required', 'string', 'max:255'],
            'amount'        => ['required', 'numeric'],
            'purchase_date' => ['required'],
            'status'        => ['required', 'string'],
        ];
    }


    public function messages(): array
    {
        return [
            'invoice_id.required'    => 'The invoice ID is required.',
            'invoice_id.unique'      => 'This invoice ID has already been used.',
            'item_name.required'     => 'The item name cannot be empty.',
            'item_name.string'       => 'The item name must be a valid string.',
            'item_name.max'          => 'The item name must not exceed 255 characters.',
            'amount.required'        => 'The amount field is required.',
            'amount.numeric'         => 'The amount must be a valid number.',
            'purchase_date.required' => 'Please select a purchase date.',
            'status.required'        => 'The status field is required.',
            'status.string'          => 'The status must be a valid string.',
        ];
    }
}