<?php

namespace App\Models;

use App\Models\Base\BaseSysAdminUser;
use Illuminate\Database\Eloquent\Model;

class SysAdminUser extends BaseSysAdminUser
{
    public function dept(){
        return $this->hasOne('App\Models\Base\BaseSysAdminDepartment','id','department_id');
    }
    public function posi(){
        return $this->hasOne('App\Models\Base\BaseSysAdminPosition','id','position_id');
    }
}
