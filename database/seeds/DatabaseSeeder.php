<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Base\BaseSysAdminUser::truncate();
        \App\Models\Base\BaseSysAdminUser::insert([
            [
                "id"=> 1,
                "login_name"=> "yaoyao",
                "uname"=> "姚瑶",
                "email"=> "yao_ivene@163.com",
                "tel"=> "18610116681",
                "pwd"=> '$2y$10$Jq7FvwYqewIllxGI249I/uw3Lm1JZ2Q5W5PUSOPcXia5ix1BPtFMK',
                "avatr"=> "",
                "department_id"=> 1,
                "position_id"=> "1",
                "status"=> 1,
                "created_at"=> "2018-06-22 02:38:50",
                "updated_at"=> "2018-08-21 16:44:37"
            ]
        ]);

        \App\Models\Base\BaseSysAdminPower::truncate();
        \App\Models\Base\BaseSysAdminPower::insert([

            [
                "id"=> 1,
                "pname"=> "系统管理",
                "ptype"=> 1,
                "icon"=> "fa-space-shuttle",
                "desc"=> "",
                "purl"=> "#",
                "parent_id"=> 0,
                "pindex"=> 1,
                "status"=> 1,
                "created_at"=> "2018-06-22 10:06:52",
                "updated_at"=> "2018-07-03 16:50:41"
            ],
            [
                "id"=> 2,
                "pname"=> "权限管理",
                "ptype"=> 1,
                "icon"=> "#",
                "desc"=> "",
                "purl"=> "Admin\\PowerController@list",
                "parent_id"=> 1,
                "pindex"=> 1,
                "status"=> 1,
                "created_at"=> "2018-06-22 10:50:01",
                "updated_at"=> "2018-06-22 10:50:01"
            ],
            [
                "id"=> 3,
                "pname"=> "部门管理",
                "ptype"=> 1,
                "icon"=> "#",
                "desc"=> "",
                "purl"=> "Admin\\DepartmentController@list",
                "parent_id"=> 1,
                "pindex"=> 1,
                "status"=> 1,
                "created_at"=> "2018-06-24 11:35:06",
                "updated_at"=> "2018-06-24 11:35:06"
            ],
            [
                "id"=> 4,
                "pname"=> "职位管理",
                "ptype"=> 1,
                "icon"=> "#",
                "desc"=> "",
                "purl"=> "Admin\\PositionController@list",
                "parent_id"=> 1,
                "pindex"=> 1,
                "status"=> 1,
                "created_at"=> "2018-06-24 11:37:08",
                "updated_at"=> "2018-06-24 11:37:08"
            ],
            [
                "id"=> 5,
                "pname"=> "账号管理",
                "ptype"=> 1,
                "icon"=> "#",
                "desc"=> "",
                "purl"=> "Admin\\UserController@list",
                "parent_id"=> 1,
                "pindex"=> 1,
                "status"=> 1,
                "created_at"=> "2018-06-24 11:37:19",
                "updated_at"=> "2018-06-25 06:12:39"
            ]
        ]);
        \App\Models\Base\BaseSysAdminDepartment::truncate();
        \App\Models\Base\BaseSysAdminDepartment::insert([
            [
                "id"=> 0,
                "dp_name"=> "无",
                "parent_id"=> -1,
                "root_id"=> 0,
                "level"=> 1,
                "path"=> "|",
                "powerid"=> "|",
                "status"=> 1,
                "created_at"=> null,
                "updated_at"=> null
            ],
            [
                "id"=> 1,
                "dp_name"=> "管理员",
                "parent_id"=> 0,
                "root_id"=> 1,
                "level"=> 1,
                "path"=> "|1|",
                "powerid"=> "|",
                "status"=> 1,
                "created_at"=> null,
                "updated_at"=> null
            ]
        ]);
        \App\Models\Base\BaseSysAdminPosition::truncate();
        \App\Models\Base\BaseSysAdminPosition::insert([
            [
                "id"=> 1,
                "position_name"=> "超级管理员",
                "department_id"=> 1,
                "desc"=> "超级管理员",
                "powerid"=> "ALL",
                "status"=> 1,
                "created_at"=> "2018-06-22 07:04:10",
                "updated_at"=> "2018-06-23 10:39:34"
            ]
        ]);
    }
}
