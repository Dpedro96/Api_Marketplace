<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'code'              => 'sometimes|string|max:255|unique:coupons,code,' . $this->route('coupon'),
            'startDate'         => 'sometimes|date|before_or_equal:endDate', 
            'endDate'           => 'sometimes|date|after_or_equal:startDate', 
            'discountPercentage'=> 'sometimes|numeric|min:0|max:100',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'code.string'            => 'O código do cupom deve ser uma string válida.',
            'code.max'               => 'O código do cupom não pode ter mais de 255 caracteres.',
            'code.unique'            => 'Este código de cupom já está em uso.',
            'startDate.date'         => 'A data de início deve ser uma data válida.',
            'startDate.before_or_equal' => 'A data de início não pode ser posterior à data de término.',
            'endDate.date'           => 'A data de término deve ser uma data válida.',
            'endDate.after_or_equal' => 'A data de término deve ser posterior ou igual à data de início.',
            'discountPercentage.numeric' => 'O percentual de desconto deve ser um número.',
            'discountPercentage.min'     => 'O percentual de desconto não pode ser menor que 0.',
            'discountPercentage.max'     => 'O percentual de desconto não pode ser maior que 100.',
        ];
    }
}
