<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManageController extends Controller
{
    //用户列表
    public function list ()
    {
    	return view('admin.user.list');
    }

    //用户新增
    public function add ()
    {
    	return view('admin.user.add');
    }

    //用户修改
    public function update ()
    {
    	return view('admin.user.update');
    }

    //用户删除 
    public function delete ()
    {
    	//删除成功返回用户列表
        return back();
    }
}
