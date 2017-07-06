<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PermissionController extends Controller
{
    //权限列表
    public function permissionList()
    {
       $permissions = Permission::paginate(5);
        return view('/admin/user/permissionList',compact('permissions'));
    }
    //添加权限
    public function permissionAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            //添加权限操作
            $permission = Permission::create($request->all());
            return redirect('admin/permission-list');
        }
        return view('/admin/user/permissionAdd');
    }
    //修改权限
    public function permissionUpdate(Request $request,$permission_id)
    {
        if($request->isMethod('post')) {
            $res = $request->except(['_token','id']);
            $result = Permission::where('id',$request->permission_id)->update($res);
            return redirect('admin/permission-list');
        }
        $permissions = Permission::where('id',$permission_id)->first();
        return view('/admin/user/permissionUpdate',compact('permissions'));
    }

    //删除权限
    public function permissionDel($permission_id)
    {
        Permission::destroy([$permission_id]);
        return redirect('admin/permission-list');
    }
}
