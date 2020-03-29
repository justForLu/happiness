<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NewsRequest extends Request
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
            'title' => 'required|max:50',
            'category_id' => 'required',
            'desc' => 'max:200',
            'image' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入新闻标题',
            'title.max' => '新闻标题不能超过50字',
            'category_id.required' => '请选择新闻分类',
            'desc.max' => '简介不能超过200字',
            'image.required' => '请上传封面图片',
        ];
    }

}