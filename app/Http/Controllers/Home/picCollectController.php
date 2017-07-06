<?php

namespace App\Http\Controllers\Home;

use App\Models\picCollect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class picCollectController extends Controller
{
    //添加收藏
    public function add(Request $request)
    {	
    	$res = picCollect::where('user_id',$request['user_id'])->where('pic_id',$request['pic_id'])->first();

    	if(!$res){
    		picCollect::create($request->all());
    		return 1;
    	} else{
    		return 0;
    	}
    }

    //收藏列表
    public function list(Request $request)
    {
    	$res = picCollect::join('zgz_users','zgz_piccollect.user_id','=','zgz_users.id')
                        ->where('pic_id',$request['pic_id'])
                        ->select('zgz_piccollect.created_at','zgz_users.userName','zgz_users.icon')
                        ->get();
    	return $res;
    	
    }

    //个人中心收藏列表
    public function userList(Request $request)
    {
        $res = picCollect::join('zgz_picture','zgz_piccollect.pic_id','=','zgz_picture.id')
                        ->join('zgz_users','zgz_picture.uid','=','zgz_users.id')
                        ->where('user_id',$request['user_id'])
                        ->select('zgz_users.userName','zgz_picture.*','zgz_piccollect.id as co_id')
                        ->get();
        return $res;
    }

    //删除用户收藏图片
    public function delete($id)
    {
        picCollect::destroy($id);
        return back();
    }
}
