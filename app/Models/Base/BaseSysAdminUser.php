<?php
namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BaseSysAdminUser extends Model
{
    protected $connection='sys_admin';
    protected $table='sys_admin_user';
    protected $primaryKey='id';
    public $timestamps = true;

    protected $fillable=[
//        'login_name',
        'uname', // 姓名
        'email', // 邮箱
        'tel', // 电话
//        'password', // 密码
        'avatr', // 用户头像
        'department_id', // 部门
        'position_id', // 职位 角色
        'status', // 状态 1 正常 -1 锁定
        'created_at', // 
        'updated_at', // 
    ];
}//Created at 2018-06-21 06:59:11