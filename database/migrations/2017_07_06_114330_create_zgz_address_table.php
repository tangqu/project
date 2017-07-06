<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZgzAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zgz_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment('用户id');
            $table->string('name')->comment('收货人');
            $table->string('phone')->commnet('收货电话');
            $table->string('address')->comment('收货地址');
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
        Schema::dropIfExists('zgz_address');
    }
}
