<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zgz_article extends Model
{
    //设置数据表
    protected $table = 'zgz_articles';
    //设置用户不需要添加的字段
    protected $guarded = ['_token','id'];
}
