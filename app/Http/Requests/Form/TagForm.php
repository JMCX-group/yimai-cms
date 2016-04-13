<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class TagForm extends Request
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
            'dept_id' => 'required|numeric|min:1',
            'dept_lv2_id' => 'required',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dept_id.required' => '一级科室不能为空',
            'dept_id.numeric' => 'test',
            'dept_id.min' => '一级科室不能为空',
            'dept_lv2_id.required' => '二级科室不能为空',
            'name.required' => '医院名称不能为空'
        ];
    }
}
