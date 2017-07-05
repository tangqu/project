<?php

namespace App\Http\Controllers\Admin;

use App\Models\zgz_user;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    //用户专辑列表
    public function userList(Request $request)
    {
    	$res = zgz_user::where('userName','like','%'.$request->search.'%')->paginate(5,['id','userName','phone']);

    	//统计所有用户的专辑数
    	foreach($res as $k=>$user){
    		$res[$k]->count = Album::where('uid',$user->id)->count();
    	}
    	
    	return view('admin.album.userlist')->with('userAlbum',$res);
    }


    //指定用户专辑列表
    public function albumList($id)
    {
    	
    	$res = Album::where('uid',$id)->paginate(5);

    	//统计用户对应专辑的图片数
    	foreach($res as $k=>$user){
    		$res[$k]->count = Picture::where('aid',$user->id)->count();
    	}
    
    	return view('admin.album.albumList')->with('albumInfo',$res);
    }

    //查看专辑图片
    public function picList($id)
    {
        $res = Picture::where('aid',$id)->where('detector','<>',0)->paginate(5);

        return view('admin.album.picList')->with('picInfo',$res);
    }
}
