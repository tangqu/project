<?php

namespace App\Http\Controllers\Home;

use App\Models\Album;
use App\Models\Picture;
use App\Models\picCollect;
use App\Models\picPraise;
use App\Http\Requests\AddAlbumRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ALbumController extends Controller
{
    //添加用户专辑
    public function add(AddAlbumRequest $request)
    {
    	Album::create($request->all());
    }

    //修改用户专辑
    public function update(AddAlbumRequest $request)
    {
    	$res = $request->except(['_token','id']);
        Album::where('id',$request->id)->update($res);
    }

    //删除专辑
    public function delete($id,$uid)
    {
        if(Picture::where('aid',$id)->first()){
            return back();
        }else{
            Album::find($id)->delete();
            return redirect('home/user/person/'.$uid);
        }
   	    
    }

    //显示专辑下的图片
    public function picList($id)
    {
    	$albumInfo = Album::join('zgz_users','zgz_album.uid','=','zgz_users.id')
                            ->where('zgz_album.id',$id)
                            ->select('zgz_users.userName','zgz_users.icon','zgz_album.*')
                            ->first();
    	$count = Picture::where('aid',$id)->where('detector',2)->count();
    	$picInfo = Picture::where('aid',$id)->where('detector',2)->paginate(15);


    	return view('home.picture.userPic')->with(['albumInfo'=>$albumInfo,'picInfo'=>$picInfo,'count'=>$count]);
    }
}
