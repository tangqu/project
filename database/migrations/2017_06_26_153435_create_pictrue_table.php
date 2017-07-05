<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictrueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictrue', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid')->comment('专辑ID');
            $table->integer('cid')->comment('分类ID');
            $table->integer('uid')->comment('用户ID');
            $table->string('picName')->comment('图片名');
            $table->string('picDesc')->comment('图片描述');
            $table->tinyInteger('detector')->default(1)->comment('0:未通过;1:未审核;2:已通过');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictrue');
    }
}
