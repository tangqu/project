<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zgz_address extends Model
{
    //设置数据表
    protected $table = 'zgz_address';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];
}
