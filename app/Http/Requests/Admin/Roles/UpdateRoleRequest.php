<?php

namespace App\Http\Requests\Admin\Roles;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        // Lấy thông tin role từ route. Laravel sử dụng route model binding để tự động tìm kiếm bản ghi tương ứng với ID đã cung cấp trong URL.
        $roleId = $this->route('role')->id ?? null;
        return [
           'name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('roles')->ignore($roleId),
        ],
        'description' => [
            'string',
            'max:255',
            Rule::unique('roles')->ignore($roleId),
        ],
            // Các trường khác với các quy tắc validate tương tự
        ];
    }
}
