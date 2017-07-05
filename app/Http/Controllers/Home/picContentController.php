<?php

namespace App\Http\Controllers\Home;

use App\Models\picContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class picContentController extends Controller
{
    //为图片添加评论
    public function add(Request $request)
    {
    	$res = picContent::where('pic_id',$request['pic_id'])->where('user_id',$request['user_id'])->first();

    	if(!$res){
    		picContent::create($request->all());
    		return 1;
    	} else {
    		return 0;
    	}
    }

    //查看图片评论
    public function list(Request $request)
    {
       $res = picContent::join('zgz_users','zgz_piccontent.user_id','=','zgz_users.id')
                        ->where('pic_id',$request['pic_id'])
                        ->select('zgz_piccontent.*','zgz_users.userName','zgz_users.icon')
                        ->get();
        return $res;
    }

    //修改图片评价
    public function update(Request $request)
    {
        $res = picContent::where('id',$request->id)->update(['content'=>$request->content]);
        return $res;
    }

    //删除评价
    public function delete($id)
    {
        picContent::destroy($id);
        return back();
    }
}
