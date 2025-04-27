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

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'street.sometimes'  => 'Se o campo "rua" for preenchido, deve ser um texto com até 255 caracteres.',
            'street.string'     => 'O campo "rua" deve ser uma string válida.',
            'street.max'        => 'O campo "rua" não pode ultrapassar 255 caracteres.',
            
            'number.sometimes'  => 'Se o campo "número" for preenchido, ele deve ser um número maior ou igual a 1.',
            'number.numeric'    => 'O campo "número" deve ser um número.',
            'number.min'        => 'O campo "número" deve ser maior ou igual a 1.',
            
            'zip.sometimes'     => 'Se o campo "CEP" for preenchido, ele deve ter entre 5 e 10 caracteres.',
            'zip.string'        => 'O campo "CEP" deve ser uma string.',
            'zip.digits_between'=> 'O campo "CEP" deve ter entre 5 e 10 caracteres.',
            
            'city.sometimes'    => 'Se o campo "cidade" for preenchido, ele deve ser um texto com até 100 caracteres.',
            'city.string'       => 'O campo "cidade" deve ser uma string válida.',
            'city.max'          => 'O campo "cidade" não pode ultrapassar 100 caracteres.',
            
            'state.sometimes'   => 'Se o campo "estado" for preenchido, ele deve ser um texto com até 100 caracteres.',
            'state.string'      => 'O campo "estado" deve ser uma string válida.',
            'state.max'         => 'O campo "estado" não pode ultrapassar 100 caracteres.',
            
            'country.sometimes' => 'Se o campo "país" for preenchido, ele deve ser um texto com até 100 caracteres.',
            'country.string'    => 'O campo "país" deve ser uma string válida.',
            'country.max'       => 'O campo "país" não pode ultrapassar 100 caracteres.',
        ];
    }
}
