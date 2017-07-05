<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAlbumRequest extends FormRequest
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
            'albumName' => 'required|between:1,11|',
            'desc' => 'between:2,50',
            'label' => 'between:2,11'
        ];
    }
    public function messages()
    {
        return [
            'albumName.required' => '专辑名不能为空',
            'albumName.between' => '专辑名过长',
            'desc.between' => '专辑描述不能大于100个字符',
            'label.between' => '专辑标签过长'
        ];
    }
}
