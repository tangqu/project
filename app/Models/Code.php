<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //设置表名
    protected $table = 'zgz_code';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];
}
