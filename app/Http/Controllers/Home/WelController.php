<?php

namespace App\Http\Controllers\Home;

use App\Models\picCollect;
use App\Models\picPraise;
use App\Models\Album;
use App\Models\Picture;
use App\Models\zgz_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelController extends Controller
{
    //进入首页
    public function welcome()
    {
    	$picInfo = Album::find(1)->picture->first();
    	$album = Album::paginate(5);
    	foreach( $album as $k=>$v ){
    		$album[$k]['picName'] = Album::find($v['id'])->picture->first()['picName'];
    		$album[$k]['count'] = Picture::where('aid',$v['id'])->count();
    		$album[$k]['userName'] = zgz_user::where('id',$v['uid'])->first()['userName'];
    	}
    	$allPicInfo = Picture::where('detector',2)->get();

    	return view('welcome')->with(['album'=>$album,'allPicInfo'=>$allPicInfo]);
    }

    //进入更多专辑页
    public function moreAlbum()
    {
        $album = Album::paginate(20);
        foreach( $album as $k=>$v ){
            $album[$k]['picName'] = Album::find($v['id'])->picture->first()['picName'];
            $album[$k]['count'] = Picture::where('aid',$v['id'])->count();
            $album[$k]['userName'] = zgz_user::where('id',$v['uid'])->first()['userName'];
        }
        return view('home.comUser.moreAlbum')->with(['album'=>$album]);
    }

    //进入图片详情页
    public function delate($id)
    {
    	$picInfo = Picture::where('id',$id)->first();

    	$fbInfo = Picture::find($id)->allPic;

    	$alInfo = Picture::find($id)->picAlbum;

    	$dzCount = picPraise::where('pic_id',$id)->where('status',1)->count();

        $ccCount = picCollect::where('pic_id',$id)->count();        

    	return view('home.comUser.delate')->with(['picInfo'=>$picInfo,'fbInfo'=>$fbInfo,'alInfo'=>$alInfo,'dzCount'=>$dzCount,'ccCount'=>$ccCount]);
    }
    
}
