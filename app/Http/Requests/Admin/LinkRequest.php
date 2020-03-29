<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class LinkRequest extends Request
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
            'title' => 'required|max:10',
            'url' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入友情链接名称',
            'title.max' => '友情链接名称不能超过10个字',
            'url.required' => '请输入友情链接地址',
        ];
    }

}