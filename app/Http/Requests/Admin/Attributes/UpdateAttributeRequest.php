<?php

namespace App\Http\Requests\Admin\Attributes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateAttributeRequest extends FormRequest
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
            'name' => 'max:100|string|required|'.Rule::unique('attributes', 'name')->ignore($this->attribute),
            'slug' => 'max:100|string|required|'.Rule::unique('attributes', 'slug')->ignore($this->attribute),
            'description' => 'string|nullable|max:500',
            'is_active' => 'required|boolean',
        ];
    }

    public function prepareForValidation()
    {
        if (request('slug')) {
            $attributeSlug = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('slug')));
        }else{
            $attributeSlug = Str::slug(preg_replace('/[^A-Za-z0-9\s]/', '-', request('name')));
        }

        $this->merge([
            'slug' => $attributeSlug,
        ]);
    }
}
