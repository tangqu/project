<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //设置表名
    protected $table = 'roles';
    public $fillable = ['name', 'display_name', 'description'];
}

