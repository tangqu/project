<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userName',32)->unique()->comment('用户名');
            $table->string('phone',11)->unique()->comment('手机号');
            $table->string('password')->comment('用户登录密码');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->integer('sex')->default(1)->comment('0:男;1:女');
            $table->string('city')->nullable()->comment('用户地址');
            $table->string('desc')->nullable()->comment('描述');
            $table->string('icon')->default('images/user\icon.png')->comment('用户头像');
            $table->integer('status')->default(1)->comment('0:禁用;1:激活');
            $table->integer('reg_status')->default(1)->comment('0:下线;1:在线');
            $table->rememberToken();
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
        Schema::dropIfExists('zgz_users');
    }
}
