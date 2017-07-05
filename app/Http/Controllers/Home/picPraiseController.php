<?php

namespace App\Http\Controllers\Home;

use App\Models\picPraise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class picPraiseController extends Controller
{
    //添加图片点赞
    public function praiseAdd(Request $request)
    {
    	
    	$res = picPraise::where('uid',$request['uid'])->where('pic_id',$request['pic_id'])->first();

    	if(!$res){
    		picPraise::create($request->all());
    		return 1;
    	} elseif($res && $res['status'] == 0){
    		picPraise::where('id',$res['id'])->update(['status'=>1]);
    		return 1;
    	} elseif($res && $res['status'] == 1){
    		return 0;
    	}
    	
    }

    //取消图片点赞
    public function praiseQx(Request $request)
    {
    	$res = picPraise::where('uid',$request['uid'])->where('pic_id',$request['pic_id'])->first();
    	if(!$res || $res['status'] == 0 ){
    		return 0;
    	} else if ($res['status'] == 1){
    		picPraise::where('id',$res['id'])->update(['status'=>0]);
    		return 1;
    	}
    }
}
