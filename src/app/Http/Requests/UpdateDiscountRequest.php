<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
            'description'         => 'sometimes|string|max:255',
            'startDate'           => 'sometimes|date|before_or_equal:endDate',
            'endDate'             => 'sometimes|date|after_or_equal:startDate',
            'discountPercentage'  => 'sometimes|numeric|min:0|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'description.string'         => 'A descrição deve ser uma string válida.',
            'description.max'            => 'A descrição não pode ter mais de 255 caracteres.',
            'startDate.date'             => 'A data de início deve ser uma data válida.',
            'startDate.before_or_equal'  => 'A data de início não pode ser posterior à data de término.',
            'endDate.date'               => 'A data de término deve ser uma data válida.',
            'endDate.after_or_equal'     => 'A data de término deve ser posterior ou igual à data de início.',
            'discountPercentage.numeric' => 'O percentual de desconto deve ser um número.',
            'discountPercentage.min'     => 'O percentual de desconto não pode ser menor que 0.',
            'discountPercentage.max'     => 'O percentual de desconto não pode ser maior que 100.',
        ];
    }
}
