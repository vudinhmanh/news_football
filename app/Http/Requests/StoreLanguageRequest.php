<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'canonical' => 'required|string|min:2|unique:languages',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên của ngôn ngữ',
            'name.string' => 'Bạn hãy nhập ngôn ngữ phù hợp',
            'name.min' => 'Bạn hãy nhập ngôn ngữ phù hợp',
            'canonical.required' => 'Bạn chưa nhập từ khoá của ngôn ngữ',
            'canonical.unique' => 'Từ khoá đã tồn tại hãy chọn từ khoá khác',
            'canonical.string' => 'Bạn hãy nhập từ khoá phù hợp',
            'canonical.min' => 'Bạn hãy nhập từ khoá phù hợp',
        ];
    }
}
