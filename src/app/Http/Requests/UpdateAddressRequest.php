<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Pode customizar com política se necessário
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'street'  => 'sometimes|string|max:255',
            'number'  => 'sometimes|numeric|min:1',
            'zip'     => 'sometimes|string|digits_between:5,10',
            'city'    => 'sometimes|string|max:100',
            'state'   => 'sometimes|string|max:100',
            'country' => 'sometimes|string|max:100',
        ];
    }
}
