<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'address_id' => 'required|exists:addresses,id',
            'coupon_id'  => 'sometimes|exists:coupons,id'
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'address_id.required' => 'O endereço é obrigatório para finalizar o pedido.',
            'address_id.exists'   => 'O endereço selecionado não foi encontrado.',

            'coupon_id.exists'    => 'O cupom informado não é válido.',
        ];
    }
}
