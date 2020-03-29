<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ExampleRequest extends Request
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
            'title' => 'required|max:32',
            'desc' => 'max:200',
            'image' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入案例标题',
            'title.max' => '案例标题不能超过32个字',
            'desc.max' => '案例简介不能超过200字',
            'image.required' => '请上传封面图片',
        ];
    }

}