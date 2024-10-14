<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

          // Lấy ID của người dùng hiện tại từ route parameter
          $userId = $this->route('user')->id ?? null;
          return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'username' => 'required|string|unique:users,username,' . $userId,
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/' . $userId,
            // Các trường khác với các quy tắc validate tương tự
        ];
    }
}
