<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Normalmente você coloca true aqui se não está usando política de autorização ainda
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
            'street'     => 'required|string|max:255',
            'number'     => 'required|string|max:10', 
            'complement' => 'nullable|string|max:100',
            'district'   => 'required|string|max:100', 
            'zip'        => 'required|string|regex:/^\d{5}-?\d{3}$/', 
            'city'       => 'required|string|max:100',
            'state'      => 'required|string|size:2',
            'country'    => 'required|string|max:100',
        ];
    }

    /**
     * Custom error messages (opcional).
     */
    public function messages(): array
    {
        return [
            'zip.regex' => 'O CEP deve estar no formato 00000-000 ou 00000000.',
            'state.size' => 'O estado deve ser representado por 2 letras (ex: SP).',
        ];
    }
}
