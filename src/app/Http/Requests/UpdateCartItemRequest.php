<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1'
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'quantity.required' => 'A quantidade do item é obrigatória.',
            'quantity.integer'  => 'A quantidade do item deve ser um número inteiro.',
            'quantity.min'      => 'A quantidade do item deve ser pelo menos 1.',
        ];
    }
}
