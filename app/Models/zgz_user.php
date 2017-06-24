<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class zgz_user extends Authenticatable
{
    //设置用户不需要添加的字段
    protected $guarded = ['_token','phoneCode'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
