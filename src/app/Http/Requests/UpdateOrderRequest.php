<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status' => 'sometimes|in:PENDING,PROCESSING,SHIPPED,COMPLETED,CANCELED',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'status.in' => 'O status da ordem deve ser um dos seguintes: PENDING, PROCESSING, SHIPPED, COMPLETED ou CANCELED.',
        ];
    }
}
