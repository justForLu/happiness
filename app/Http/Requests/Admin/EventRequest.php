<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class EventRequest extends Request
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
            'content' => 'required|max:200',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入案例标题',
            'title.max' => '日程标题不能超过32个字',
            'content.required' => '日程内容不能为空',
            'content.max' => '日程内容不能超过200字',
        ];
    }

}