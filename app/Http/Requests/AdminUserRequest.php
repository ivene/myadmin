<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AdminUserRequest extends FormRequest
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
        $id = Input::get('id');
        $addRules=[
            'login_name' =>'required|unique:sys_admin.sys_admin_user,login_name',
            'uname' =>'required',
            'email' =>'required|unique:sys_admin.sys_admin_user,email',
            'tel' =>'required|unique:sys_admin.sys_admin_user,tel',
            'pwd' =>'required',
        ];
        $updateRules=[
            'login_name' =>'required|unique:sys_admin.sys_admin_user,login_name,'.$id.',id',
            'uname' =>'required',
            'email' =>'required|unique:sys_admin.sys_admin_user,email,'.$id.',id',
            'tel' =>'required|unique:sys_admin.sys_admin_user,tel,'.$id.',id',
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
            'name.required'=>'用户名称不能为空',
            'name.unique'=>'用户名称不能重复',
            'email.required'=>'邮箱名称不能为空',
            'email.unique'=>'邮箱名称不能重复',
            'tel.required'=>'手机号不能为空',
            'tel.unique'=>'手机号不能重复',
            'pwd.required'=>'密码不能为空',
        ];
    }
}
