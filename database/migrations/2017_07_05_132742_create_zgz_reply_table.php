<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZgzReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tid')->comment('评论文章id');
            $table->unsignedBigInteger('cid')->comment('回复评论id');
            $table->string('re_name',32)->comment('名字');
            $table->unsignedBigInteger('to_uid')->comment('目标用户id');
            $table->string('comment',255)->comment('回复评论');
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
        Schema::dropIfExists('zgz_reply');
    }
}
