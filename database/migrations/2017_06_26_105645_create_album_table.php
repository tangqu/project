<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_album', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户id');
            $table->string('albumName')->comment('专辑名');
            $table->string('desc')->nullable()->comment('专辑标签');
            $table->string('label')->nullable()->comment('专辑标签');
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
        Schema::dropIfExists('zgz_album');
    }
}
