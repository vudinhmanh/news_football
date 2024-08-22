<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users',
            'name' => 'required|string',
            'birthday' => 'required',
            'user_catalogue_id' => 'required|gt:0',
            'password' => 'required|string|min:6',
            're_password' =>'required|string|min:6|same:password',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập vào email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Bạn chưa nhập vào tên',
            'user_catalogue_id.required' => 'Bạn chưa chọn nhóm thành viên',
            'user_catalogue_id.gt' => 'Hãy chọn 1 nhóm thành viên', // Thêm thông điệp cho điều kiện "greater than"
            'birthday.required' => 'Bạn chưa nhập ngày sinh',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            're_password.required' => 'Bạn chưa nhập lại mật khẩu',
            're_password.min' => 'Mật khẩu nhập lại phải có ít nhất 6 ký tự',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
        ];
    }
}
