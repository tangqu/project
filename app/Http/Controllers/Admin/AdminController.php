<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //进入后台首页
    public function index()
    {
    	return view('admin.index');
    }

    //跳转修改管理员密码页面
    public function editPass()
    {
    	return view('admin.pass');
    }
}
