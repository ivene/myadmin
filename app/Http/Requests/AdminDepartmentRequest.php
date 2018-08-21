<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AdminDepartmentRequest extends FormRequest
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
        $id= Input::get('id');
        $addRules=[
            'dp_name' =>'required|unique:sys_admin.sys_admin_department,dp_name',
            'powerid' =>'required',
        ];
        $updateRules=[
            'dp_name' =>'required|unique:sys_admin.sys_admin_department,dp_name,'.$id.',id',
            'powerid' =>'required',
        ];

        if ($id > 0){
            return $updateRules;
        }else{
            if(Input::get('pid')>0){
                array_push($addRules,['parent_id' =>'required']);
            }
            return $addRules;
        }

    }

    public function messages()
    {
        return [
            'dp_name.required'=>'部门名称不能为空',
            'dp_name.unique'=>'部门名称不能重复',
            'parent_id.required'=>'归属部门不能为空',
            'powerid.required'=>'部门权限不能为空',
        ];
    }
}
