<?php

namespace App\Http\Requests\Admin\AttributeValues;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeValueRequest extends FormRequest
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
            'name' => 'required|max:100|'.Rule::unique('attribute_values', 'name')->ignore($this->attributeValue),
            'slug' => 'nullable|max:255|'.Rule::unique('attribute_values', 'slug')->ignore($this->attributeValue),
            'description' => 'nullable|max:500',
            'is_active' => 'required|boolean',
        ];
    }
}
