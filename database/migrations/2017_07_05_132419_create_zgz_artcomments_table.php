<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZgzArtcommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_artcomments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('tid');
            $table->string('userName',32);
            $table->string('comment', 255);
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
        Schema::dropIfExists('zgz_artcomments');
    }
}
