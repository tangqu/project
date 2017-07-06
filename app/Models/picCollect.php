<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class picCollect extends Model
{
    //设置表名
    protected $table = 'zgz_piccollect';

    protected $fillable = ['user_id', 'pic_id'];

}
