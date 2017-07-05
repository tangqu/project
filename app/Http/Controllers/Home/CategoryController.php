<?php

namespace App\Http\Controllers\Home;

use App\Models\Picture;
use App\Models\CateGory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //一级分类查询显示
    public function cateFirst()
    {
    	$res = CateGory::where('pid',0)->where('display',1)->get();
    	return $res;
    }

    //分类查询
    public function cateList($id,$cateName)
    {
    	$res = CateGory::where('path','like','%,'.$id.',%')
    					->get();

        $thirdCate = '';
    	foreach($res as $v){
            if($v['path'] == 3){
                $thirdCate[] = $v;
            }
        }
        $string = '';
        if($thirdCate){
            foreach($thirdCate as $v){
                $string .= $v['id'].',';
            }
        }
        $area = rtrim($string,',');

        $catePic = Picture::where('detector',2)->whereIn('cid',[$area])->get();

        return view('home.comUser.category')->with(['thirdCate'=>$thirdCate,'cate'=>$cateName,'catePic'=>$catePic]);
    }

    //三级分类查询
    public function thirdSel(Request $request)
    {
        $res = Picture::where('cid',$request['cid'])->where('detector',2)->get();

        return $res;
    }
}
