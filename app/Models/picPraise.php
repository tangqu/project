<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class picPraise extends Model
{
    //设置表名
    protected $table = 'zgz_picpraise';

    public $timestamps = false;

    protected $fillable = ['uid', 'pic_id'];
}
