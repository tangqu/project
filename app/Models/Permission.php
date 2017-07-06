<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;;

class Permission extends EntrustPermission
{
    //设置用户不需要添加的字段
    public $fillable = ['name', 'display_name', 'description'];
}
