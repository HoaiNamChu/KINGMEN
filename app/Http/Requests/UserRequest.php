<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //

            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|in:admin,user', // giả sử bạn có các vai trò là 'admin' và 'user'
            'password' => 'required|string|min:6|confirmed', // yêu cầu xác nhận mật khẩu
            'location' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|regex:/^[0-9]{10,15}$/', // yêu cầu định dạng số điện thoại từ 10 đến 15 ký tự
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Kiểm tra avatar là hình ảnh với định dạng cho phép 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'role.required' => 'Vai trò là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'location.required' => 'Địa chỉ là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'avatar.image' => 'Avatar phải là một hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpeg, png, jpg, hoặc gif.',
        ];
    }
}
