<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20|unique:authors,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập Tên',
            'name.max:20' => 'Tên không quá 20 ký tự',
            'name.unique' => 'Tên tác giả trùng, vui lòng chọn tác giả khác'
        ];
    }
}
