<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'name' => 'required',
            'canonical' => 'required|min:5|unique:post_catalogue_language',
            'parentid' => 'gt:0',
        ];
    }
    public function messages(): array   
    {
        return [
            'name.required' => 'Bạn chưa nhập vào tiêu đề',
            'canonical.required' => 'Bạn chưa nhập đường dẫn',
            'canonical.min' => 'Bạn hãy nhập đường dẫn phù hợp',
            'canonical.unique' => 'Đường dẫn đã tồn tại hãy chọn đường dẫn khác',
            'parentid.gt' => 'Bạn chưa nhập danh mục cha'
        ];
    }
}
