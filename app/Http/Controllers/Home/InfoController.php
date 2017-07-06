<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_address;
use App\Models\zgz_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InfoController extends Controller
{
    //进入编辑个人信息页
    public function infoEdit()
    {
        $id = Auth::user()->id;
        $info = zgz_user::where('id',$id)->first();
    	//地址视图
        $address = zgz_address::all();
        return view('home.user.infoEdit')->with('info',$info)
                                            ->with('address',$address);
    }

    //个人资料修改
    public function infoUpdate(Request $request)
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
        return back();
    }
    //邮箱修改
    public function emailUpdate(Request $request)
    {
        if (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->password])){
            $email = $request->all()['email'];
            zgz_user::where('id',$request->id)->update(['email'=>$email]);
            return redirect('/home/user/infoEdit');
        } else {
            return back();
        }
    }
    //密码修改
    public function passEdit(Request $request)
    {
        $a = $request->all()['new_pass'];
        if(Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->old_pass])){
            if($request->all()['new_pass'] == $request->all()['reNew_pass']){
                zgz_user::where('id',$request->id)->update(['password'=>Hash::make($a)]);
            }
           return redirect('/home/user/infoEdit');
        }else{
            return back();
        }

    }
}
