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
            'image'       => 'sometimes|file|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
