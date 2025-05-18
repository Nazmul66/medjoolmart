<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRuleRequest extends FormRequest
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
        $id = $this->route('shipping_rule');

        return [
            'name'     => ['required', "unique:shipping_rules,name,$id", 'max:200'],
            'min_cost' => ['nullable','numeric', 'min:0'],
            'cost'     => ['required', 'integer', 'min:0'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'  => 'Name is required',
            'name.unique'    => 'Character might be unique',
            'name.max'       => 'Character should be 200 words',
            'min_cost.min'   => 'The minimum cost must be at least 0.', 
            'cost.required'  => 'Cost is required',
            'cost.min'       => 'The cost must be at least 0.',
        ];
    }
}
