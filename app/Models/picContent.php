<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class picContent extends Model
{
    //设置表名
    protected $table = 'zgz_piccontent';
    //设置用户不需要添加的字段
    protected $guarded = ['_token'];

    public function picContentUser()
    {
    	return $this->belongsTo('App\Models\zgz_user','user_id');
    }

}
