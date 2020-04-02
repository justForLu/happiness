<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class RememberRequest extends Request
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
            'title' => 'required|max:30',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入纪念日标题',
            'title.max' => '纪念日标题不能超过30个字',
        ];
    }

}