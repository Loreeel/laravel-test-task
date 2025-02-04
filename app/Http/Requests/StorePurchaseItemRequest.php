<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => ['required','numeric'],
            'purchase_id' => ['required', 'exists:purchases,id'],
            'product_id' => ['required', 'exists:products,id'],
            // 'price' => ['required','numeric','regex:/^\d+(\.\d{1,2})?$/'],
            //'total' => ['required','numeric','regex:/^\d+(\.\d{1,2})?$/']
        ];
    }
}
