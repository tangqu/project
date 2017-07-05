<?php

namespace App\Http\Controllers\Admin;

use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PictureController extends Controller
{
    //进入图片管理页
    public function manager($id)
    {
    	$picMangerInfo = Picture::join('zgz_users','zgz_picture.uid','=','zgz_users.id')
    							->where('detector',$id)
    							->select('zgz_users.userName','zgz_picture.*')
    							->paginate(5);

    	return view('admin.picture.manager')->with('picMangerInfo',$picMangerInfo);
    }

    //图片待审核
    public function sh($id)
    {
    	Picture::where('id',$id)->update(['detector'=>1]);
    	return back();
    }

    //图片通过
    public function yes($id)
    {
    	Picture::where('id',$id)->update(['detector'=>2]);
    	return back();
    }

    //图片未通过
    public function no($id)
    {
    	Picture::where('id',$id)->update(['detector'=>0]);
    	return back();
    }

    //图片待审核
    public function delete($id)
    {
    	$res = Picture::find($id);
        $res->delete();
        $delete = unlink($res['picName']);
        return back();
    }

}
