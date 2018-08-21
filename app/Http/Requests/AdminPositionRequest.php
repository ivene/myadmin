<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AdminPositionRequest extends FormRequest
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
        $id=Input::get('id');
        $addRules=[
            'position_name' =>'required|unique:sys_admin.sys_admin_position,position_name',
            'desc' =>'required',
            'powerid' =>'required',
        ];
        $updateRules=[
            'position_name' =>'required|unique:sys_admin.sys_admin_position,position_name,'.$id.',id',
            'desc' =>'required',
            'powerid' =>'required',
        ];
        if ($id > 0){
            return $updateRules;
        }else{
            return $addRules;
        }

    }

    public function messages()
    {
        return [
            'position_name.required'=>'职位名称不能为空',
            'position_name.unique'=>'职位名称不能重复',
            'desc.required'=>'职位说明不能为空',
            'powerid.required'=>'职位权限不能为空',
        ];
    }
}