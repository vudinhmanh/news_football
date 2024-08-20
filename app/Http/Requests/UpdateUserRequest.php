<?php

namespace App\Http\Requests;

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
        return [
            'email' => 'required|string|email|unique:users,email, '.$this->id.'|max:191',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|gt:0',
        ];
    }
    public function messages():array
    {
        return [
            'email.unique' => 'Đã có người sử dụng email này',
            'email.required' => 'Bạn chưa nhập vào email',
            'email.email' => 'Email không hợp lệ',
            'name.required' => 'Bạn chưa nhập vào tên',
            'user_catalogue_id.required' => 'Bạn chưa chọn nhóm thành viên',
        ];
    }
}
