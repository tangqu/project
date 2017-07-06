<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //分类列表显示
    public function list($pid = 0){
        $cateInfo = Category::where('pid',$pid)->select('path as px','zgz_category.*')->paginate(5);
    
        return view('admin.category.list')->with('cateInfo',$cateInfo);
    }

   	//跳转添加分类视图
   	public function add($id = 0 ,$path = '0,')
   	{
      //dd($path);
        $path = $id != 0 ? $path.$id.',' : '0,';
   	    return view('admin.category.add',['pid'=>$id,'path'=>$path]);
   	}

    //添加分类
    public function doAdd(Request $request)
    {
        Category::create($request->all());
        return redirect('/admin/category/list');
    }

   	
   	//跳转更新分类视图
   	public function update($id)
   	{
        $cateUpdate = Category::where('id',$id)->first();
   	    return view('admin.category.update')->with('cateInfo',$cateUpdate);
   	}
    //修改分类
    public function doUpdate(Request $request)
    {
        $res = $request->except(['_token','id']);
        Category::where('id',$request->id)->update($res);
        return redirect('/admin/category/list');
    }

    //修改分类显示隐藏
    public function disEdit($id,$display)
    {
        $dis = $display == 1 ? 0 : 1;
        Category::where('id',$id)->update(['display'=>$dis]);
        return back();
    }

   	//删除分类
   	public function delete($id)
   	{
        Category::find($id)->delete();
   	    return back();
   	}
    
}
