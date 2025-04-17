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
}
