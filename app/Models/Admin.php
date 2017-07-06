<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
	use EntrustUserTrait;
    use Notifiable;
    //设置表名
    protected $table = 'manger';

    protected $guarded = ['_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
