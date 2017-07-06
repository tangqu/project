<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateGory extends Model
{
    //设置表名
    protected $table = 'zgz_category';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];

    public $timestamps = false;

    //修改分类表访问时路径字段的数据
    public function getPathAttribute($value)
    {
        //return $value;
    	return substr_count($value, ',');
    }
}
