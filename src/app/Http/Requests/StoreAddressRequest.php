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
            'number'     => 'required|numeric',
            'complement' => 'nullable|string|max:100',
            'district'   => 'required|string|max:100',
            'zip'        => 'required|string|regex:/^\d{5}-?\d{3}$/',
            'city'       => 'required|string|max:100',
            'state'      => 'required|string|size:2',
            'country'    => 'required|string|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'street.required' => 'A rua é obrigatória.',
            'street.string' => 'A rua deve ser um texto.',
            'street.max' => 'A rua não pode ter mais que 255 caracteres.',

            'number.required' => 'O número é obrigatório.',
            'number.numeric' => 'O número deve ser numérico.',

            'complement.string' => 'O complemento deve ser um texto.',
            'complement.max' => 'O complemento não pode ter mais que 100 caracteres.',

            'district.required' => 'O bairro é obrigatório.',
            'district.string' => 'O bairro deve ser um texto.',
            'district.max' => 'O bairro não pode ter mais que 100 caracteres.',

            'zip.required' => 'O CEP é obrigatório.',
            'zip.string' => 'O CEP deve ser um texto.',
            'zip.regex' => 'O CEP deve estar no formato 00000-000 ou 00000000.',

            'city.required' => 'A cidade é obrigatória.',
            'city.string' => 'A cidade deve ser um texto.',
            'city.max' => 'A cidade não pode ter mais que 100 caracteres.',

            'state.required' => 'O estado é obrigatório.',
            'state.string' => 'O estado deve ser um texto.',
            'state.size' => 'O estado deve ser representado por 2 letras (ex: SP).',

            'country.required' => 'O país é obrigatório.',
            'country.string' => 'O país deve ser um texto.',
            'country.max' => 'O país não pode ter mais que 100 caracteres.',
        ];
    }
}
