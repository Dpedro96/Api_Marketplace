<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'image'       => 'sometimes|file|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório.',
            'name.string' => 'O nome da categoria deve ser um texto.',
            'name.max' => 'O nome da categoria não pode ter mais que 255 caracteres.',

            'description.required' => 'A descrição da categoria é obrigatória.',
            'description.string' => 'A descrição da categoria deve ser um texto.',
            'description.max' => 'A descrição da categoria não pode ter mais que 500 caracteres.',

            'image.file' => 'A imagem deve ser um arquivo válido.',
            'image.mimes' => 'A imagem deve ser do tipo: jpg, png ou jpeg.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ];
    }
}
