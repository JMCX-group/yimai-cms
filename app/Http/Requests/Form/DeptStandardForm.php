<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class DeptStandardForm extends Request
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
            'parent_id' => 'required',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'parent_id.required' => '一级科室不能为空',
            'name.required' => '科室名称不能为空'
        ];
    }
}
