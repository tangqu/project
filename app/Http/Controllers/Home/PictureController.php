<?php

namespace App\Http\Controllers\Home;

use App\Models\picCollect;
use App\Models\picPraise;
use App\Models\Category;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PictureController extends Controller
{
    //查看用户专辑
    public function userAlbum()
    {
    	$id = Auth::user()->id;
    	$addAlbumPic['album']= Album::where('uid',$id)->get();
    	
        $addAlbumPic['cate'] = Category::get();
        return $addAlbumPic;
    }

    //添加图片
    public function uploadImg(Request $request)
    {
        //处理图片地址
        $file = $request->file('picName');
        $path = $file -> move('images/picImg/',date(time()).'_'.uniqid().'.jpg');
        $icon = Storage::url($path);
        $icon = explode('/storage/',$icon)[1];
        $request = $request->except('picName');

        $request['picName'] = $icon;

        Picture::create($request);
        return back();
    }

    //删除图片
    public function delete($id)
    {
        $res = Picture::find($id);
        $res->delete();
        $delete = unlink($res['picName']);
        picCollect::where('pic_id',$id)->delete();
        picPraise::where('pic_id',$id)->delete();
        return back();
    }

    //个人中心查看发布图片
    public function pushPic(Request $request)
    {
        $res = Picture::where('uid',$request->uid)->get();

        return $res;
    }
}
