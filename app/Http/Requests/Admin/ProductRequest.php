<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'image' => 'required',
            'desc' => 'max:200',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入商品标题',
            'title.max' => '商品标题不能超过50字',
            'category_id.required' => '请选择商品分类',
            'image.required' => '请上传商品封面图片',
            'desc.max' => '商品简介不能超过200字',
        ];
    }

}