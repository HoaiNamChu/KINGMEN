<?php

namespace App\Http\Requests\Client\Checkouts;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:50',
            'phone' => 'required|max:20',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'house_number' => 'required',
            'note' => 'nullable|string',
            'confirm_checkout' => 'required|boolean',
        ];
    }
}
