<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //设置表名
    protected $table = 'zgz_album';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];

    /**
     * 获取专辑对应的第一张图片
     */
    public function picture()
    {
    	return $this->hasMany('App\Models\Picture','aid');
    }
    /**
     * 获取专辑对应发布的用户名
     */
    public function userName()
    {
        return $this->belongsTo('App\Models\zgz_user','uid','id');
    }
}
