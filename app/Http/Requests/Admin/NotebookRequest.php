<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NotebookRequest extends Request
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
            'content' => 'required|max:200',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入新闻标题',
            'title.max' => '标题不能超过50字',
            'content.required' => '内容不能超为空',
            'content.max' => '内容不能超过200字',
        ];
    }

}