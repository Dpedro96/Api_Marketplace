<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'   => 'sometimes|string|max:255',      
            'stock'  => 'sometimes|integer|min:0',             
            'price'  => 'sometimes|numeric|min:0.01' 
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.string'    => 'O nome do produto deve ser uma string válida.',
            'name.max'       => 'O nome do produto não pode ter mais que 255 caracteres.',
            'stock.integer'  => 'A quantidade de estoque deve ser um número inteiro.',
            'stock.min'      => 'A quantidade de estoque não pode ser menor que 0.',
            'price.numeric'  => 'O preço do produto deve ser um número válido.',
            'price.min'      => 'O preço do produto deve ser no mínimo 0.01.',
        ];
    }
}
