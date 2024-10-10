<?php

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
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
            'name' => 'required|max:100|'.Rule::unique('tags', 'name')->ignore($this->tag),
            'slug' => 'nullable|max:100|'.Rule::unique('tags','slug')->ignore($this->tag),
            'description' => 'nullable|max:500',
            'is_active' => 'required|boolean',
        ];
    }
}
