<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'code'              => 'required|string|max:255|unique:coupons,code',
            'startDate'         => 'required|date|before_or_equal:endDate',
            'endDate'           => 'required|date|after_or_equal:startDate', 
            'discountPercentage'=> 'required|numeric|min:0|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'code.required' => 'O código do cupom é obrigatório.',
            'code.string' => 'O código do cupom deve ser um texto.',
            'code.max' => 'O código do cupom não pode ter mais que 255 caracteres.',
            'code.unique' => 'Este código de cupom já está sendo utilizado.',

            'startDate.required' => 'A data de início é obrigatória.',
            'startDate.date' => 'A data de início deve ser uma data válida.',
            'startDate.before_or_equal' => 'A data de início deve ser anterior ou igual à data de término.',

            'endDate.required' => 'A data de término é obrigatória.',
            'endDate.date' => 'A data de término deve ser uma data válida.',
            'endDate.after_or_equal' => 'A data de término deve ser posterior ou igual à data de início.',

            'discountPercentage.required' => 'O percentual de desconto é obrigatório.',
            'discountPercentage.numeric' => 'O percentual de desconto deve ser um número.',
            'discountPercentage.min' => 'O percentual de desconto deve ser no mínimo 0%.',
            'discountPercentage.max' => 'O percentual de desconto não pode ultrapassar 100%.',
        ];
    }
}
