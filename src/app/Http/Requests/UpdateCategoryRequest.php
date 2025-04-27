<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:500'
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.string'        => 'O nome da categoria deve ser uma string válida.',
            'name.max'           => 'O nome da categoria não pode ter mais de 255 caracteres.',
            'description.string' => 'A descrição da categoria deve ser uma string válida.',
            'description.max'    => 'A descrição da categoria não pode ter mais de 500 caracteres.',
        ];
    }
}
