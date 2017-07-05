<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_picReply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('com_id')->comment('对应评论id');
            $table->integer('reply_id')->comment('父级回复id');
            $table->string('userS_name')->comment('回复发送用户名');
            $table->string('userR_name')->comment('回复接收用户名');
            $table->string('content')->comment('回复内容');
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
        Schema::dropIfExists('zgz_picReply');
    }
}
