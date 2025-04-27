<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'stock'        => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0.01',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'sometimes|file|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'name.string'   => 'O nome do produto deve ser um texto.',
            'name.max'      => 'O nome do produto não pode ter mais que 255 caracteres.',
            
            'stock.required' => 'O estoque é obrigatório.',
            'stock.integer'  => 'O estoque deve ser um número inteiro.',
            'stock.min'      => 'O estoque não pode ser menor que 0.',
            
            'price.required' => 'O preço é obrigatório.',
            'price.numeric'  => 'O preço deve ser um número.',
            'price.min'      => 'O preço deve ser maior que 0.',
            
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists'   => 'A categoria selecionada não foi encontrada.',
            
            'image.sometimes' => 'A imagem é opcional, mas se enviada, deve ser um arquivo válido.',
            'image.file'      => 'A imagem deve ser um arquivo.',
            'image.mimes'     => 'A imagem deve ser dos tipos: jpg, png ou jpeg.',
            'image.max'       => 'A imagem não pode ter mais que 2MB.',
        ];
    }
}
