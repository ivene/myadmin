<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_admin_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string("uname",60)->comment("姓名");
            $table->string("login_name",60)->comment("账号");
            $table->string("email",50)->comment("邮箱");
            $table->string("tel",50)->comment("电话");
            $table->string('password',50)->comment("密码");
            $table->string("avatr",100)->nullable($value=true)->comment("用户头像");
            $table->integer('department_id')->comment("部门");
            $table->integer('position_id')->comment("职位 角色");
            $table->integer('status')->default('1')->comment("状态 1 正常 -1 锁定");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_admin_user');
    }
}
