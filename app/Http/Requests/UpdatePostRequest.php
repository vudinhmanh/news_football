<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            // 'canonical' => 'required|unique:post_catalogue_language,canonical '.$this->canonical.'|max:191',
            // 'canonical' => 'required|unique:post_language,canonical, '.$this->id.',post_id',
            'post_catalogue_id' => 'gt:0'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập vào ô tiêu đề',
            // 'canonical.required' => 'Bạn chưa nhập vào ô đường dẫn',
            // 'canonical.unique' => 'Đường dẫn đã tồn tại',
            'post_catalogue_id' => 'Bạn phải nhập vào danh mục cha'
        ];
    }
}
