<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegRequest extends FormRequest
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
            'name' => 'required|regex:/^1[34578][0-9]{9}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '手机号不能为空',
            'name.regex' => '手机号格式错误',
        ];
    }


}
