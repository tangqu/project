<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZgzArtCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_artcounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->unsignedInteger('tid');
            $table->unsignedInteger('pageview')->default(0);
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
        Schema::dropIfExists('zgz_artcounts');
    }
}
