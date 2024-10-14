<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
          $userId = $this->route('user') ? $this->route('user')->id : null; // Lấy ID của user hiện tại nếu có

          return [
              'name' => 'required|string|max:255',
              'username' => [
                  'required',
                  'string',
                  'max:255',
                  Rule::unique('users')->ignore($userId), // Bỏ qua ID người dùng hiện tại
              ],
            //   'password' => 'required|string|min:4', // Yêu cầu xác nhận mật khẩu
              'address' => 'required|string|max:255',
              'email' => [
                  'required',
                  'email',
                  Rule::unique('users')->ignore($userId), // Bỏ qua ID người dùng hiện tại
              ],
              'phone' => 'required|string|regex:/^[0-9]{10,15}$/', // Yêu cầu định dạng số điện thoại từ 10 đến 15 ký tự
              'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Kiểm tra avatar là hình ảnh với định dạng cho phép 
          ];
    }
}
