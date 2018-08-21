<?php
namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BaseSysAdminPosition extends Model
{
    protected $connection='sys_admin';
    protected $table='sys_admin_position';
    protected $primaryKey='id';
    public $timestamps = true;

    protected $fillable=[
        'position_name', // 职位名称
        'department_id', // 归属部门
        'desc', // 职位描述
        'powerid', // 职位权限
        'status', // 职位状态 1 正常
        'created_at', // 
        'updated_at', // 
    ];
}//Created at 2018-06-21 06:59:55