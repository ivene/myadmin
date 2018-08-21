<?php
namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class BaseSysAdminDepartment extends Model
{
    protected $connection='sys_admin';
    protected $table='sys_admin_department';
    protected $primaryKey='id';
    public $timestamps = true;

    protected $fillable=[
        'dp_name', // 部门名称
        'parent_id', // 父部门
        'root_id', // 根部门
        'level', // 部门等级
        'path', // 部门归属
        'powerid', // 部门权限
        'status', // 部门状态 1 正常
        'created_at', // 
        'updated_at', // 
    ];
}//Created at 2018-06-28 11:25:18