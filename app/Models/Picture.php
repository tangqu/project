<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //设置表名
    protected $table = 'zgz_picture';

    //设置用户不需要添加的字段
    protected $guarded = ['_token'];

    public $timestamps = false;

    public function allPic()
    {
    	return $this->belongsTo('App\Models\zgz_user','uid');
    }

    public function picAlbum()
    {
    	return $this->belongsTo('App\Models\Album','aid');
    }

    
}
