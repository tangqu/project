<?php

namespace App\Http\Controllers\Home;

use App\Models\picReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PicReplyController extends Controller
{
    //添加回复
    public function add(Request $request)
    {
    	$res = picReply::where('com_id',$request['com_id'])->where('reply_id',$request['reply_id'])->where('userS_name',$request['userS_name'])->first();

    	if(!$res){
    		picReply::create($request->all());
    		return 1;
    	} else {
    		return 0;
    	}
    }

    //查看评论回复
    public function list(Request $request)
    {
    	//dump($request->all());
       $res = picReply::join('zgz_users','zgz_picReply.userR_name','=','zgz_users.userName')
                        ->where('com_id',$request['com_id'])
                        ->where('reply_id',$request['reply_id'])
                        ->select('zgz_picreply.*','zgz_users.icon')
                        ->get();
       return $res;
    }

    //更新评论回复
    public function update(Request $request)
    {
    	$res = picReply::where('id',$request['id'])->update(['content'=>$request['content']]);
    	return $res;
    }

    //删除回复
    public function delete($id)
    {
        picReply::destroy($id);
        return back();
    }
}
