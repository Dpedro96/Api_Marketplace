<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'image' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.required' => 'A imagem é obrigatória.',
            'image.file' => 'O arquivo enviado deve ser um arquivo válido.',
            'image.mimes' => 'A imagem deve ser do tipo JPG, PNG ou JPEG.',
            'image.max' => 'A imagem não pode ter mais que 2MB.',
        ];
    }
}
