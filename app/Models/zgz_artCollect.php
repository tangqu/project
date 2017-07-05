<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zgz_artCollect extends Model
{
    //设置数据表
    protected $table = 'zgz_artCollects';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];
    //关闭自动插入更新时间
    public $timestamps = false;
}
