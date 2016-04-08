<?php

namespace App\Http\Requests\Form;

use App\Http\Requests\Request;

class HospitalForm extends Request
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
            'city' => 'required',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'city.required' => '所属城市不能为空',
            'name.required' => '医院名称不能为空'
        ];
    }
}
