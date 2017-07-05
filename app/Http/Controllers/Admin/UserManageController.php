<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\zgz_user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
class UserManageController extends Controller
{
    //用户列表
    public function list (Request $request)
    {
        //查询所有用户数据
        $users = zgz_user::where('userName','like','%'.$request->userName.'%')->paginate(5);
        return view('admin.user.list',['users'=>$users]);

    }
    //用户状态
    public function userStutas ($id)
    {
        $user = zgz_user::where('id',$id)->first();
        $user->status == 0 ?  zgz_user::where('id',$id)->update(['status'=> 1]) : zgz_user::where('id',$id)->update(['status'=> 0]);
        return back();
    }

    //用户新增
    public function add ()
    {
        return view('admin.user.add');
    }

    //用户名验证
    public function userName()
    {
        if($_POST['userName'] == ''){
            echo 1;
        }
    }
    //密码验证
    public function password()
    {
        if($_POST['password'] == ''){
            echo 1;
        }
    }
    //手机验证
    public function phone()
    {
        $phone = $_POST['phone'];
        $preg = '/^(13|14|15|17|18)\d{9}$/';
        preg_match($preg,$phone,$match);
        if($match)
        {
            echo 1;
        }else{
            echo 2;
        }
    }
    //邮箱验证
    public function email()
    {
        $eamil = $_POST['email'];
        $patten = '/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/';
        preg_match($patten,$eamil,$match);
        if($match)
        {
            echo 1;
        }else{
            echo 2;
        }
    }

    //添加用户
    public function doAdd(Request $request)
    {
        if($request->icon) {
            $file = $request->file('icon');
            $path = $file -> move('images/user',date(time()).rand().'.jpg');
            $icon = Storage::url($path);
            $icon = explode('/storage/',$icon)[1];
            $input = $request->except('icon');
            $input['icon'] = $icon;
        }else{
            $input = $request->all();
        }
        $user = zgz_user::create($input);
        return redirect('admin/user/list');
    }

    //用户修改
    public function update ($id)
    {
        //根据id查询一条数据
        $user = zgz_user::where('id',$id)->first();
        return view('admin.user.update',['user'=>$user]);
    }
    //用户修改数据
    public function doUpadte(Request $request)
    {
        //判断是否修改头像
        if ($request->icon){
            $file = $request->file('icon');
            if($file -> isValid()){
                //检验一下上传的文件是否有效.
                $path = $file -> move('images/user',date(time()).rand().'.jpg');
                $result = zgz_user::where('id',$request->id)->update(['icon'=>$path]);
            }
        }
        $res = $request->except(['_token','id','icon']);
        $result = zgz_user::where('id',$request->id)->update($res);
        return redirect('/admin/user/list');
    }

    //用户删除 
    public function delete ($id)
    {
        zgz_user::find($id)->delete();
        //删除成功返回用户列表
        return back();
    }

    //用户详情
    public function detail($id)
    {
        //根据id查询一条数据
        $user = zgz_user::where('id',$id)->first();
        return view('admin.user.detail',['user'=>$user]);
    }
}
