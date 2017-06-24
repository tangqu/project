<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zgz_code extends Model
{
    //设置表名
    protected $table = 'zgz_code';

    //设置白名单
    protected $fillable = ['phone', 'code','deadtime'];

    //关闭自动插入更新时间
    public $timestamps = false;
}
