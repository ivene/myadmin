<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class AdminPowerRequest extends FormRequest
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
            'pname' =>'required|unique:sys_admin.sys_admin_power,pname',
           // 'icon' =>'required',
            'purl' =>'required',
        ];
        $updateRules=[
            'pname' =>'required|unique:sys_admin.sys_admin_power,pname,'.$id.',id',
            // 'icon' =>'required',
            'purl' =>'required',
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
            'pname.required'=>'权限菜单名称不能为空',
            'pname.unique'=>'权限菜单名称不能重复',
          //  'icon.required'=>'权限菜单图片不能为空',
            'purl.required'=>'权限菜单链接地址不能为空',
        ];
    }
}
