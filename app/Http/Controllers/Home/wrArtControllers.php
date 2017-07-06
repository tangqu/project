<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_artdraft;
use App\Models\zgz_article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class wrArtControllers extends Controller
{
    //写文章页面
    public function wrArt()
    {
        return view('home.art.wrArt');
    }

    //提交文章
    public function publish(Request $request)
    {
        //处理图片地址
        $file = $request->file('artPic');
        $path = $file->move('images/home/article', date(time()) . rand() . '.jpg');
        $icon = Storage::url($path);
        $icon = explode('/storage', $icon)[1];
        $request = $request->except('artPic');
        $request['artPic'] = $icon;
        zgz_article::create($request);
        return redirect('home/art/article');
    }

    //保存文章
    public function draft(Request $request)
    {
        //判断是否有图片上传
        if ($request->artPic) {
            //处理图片地址
            $file = $request->file('artPic');
            $path = $file->move('images/home/article', date(time()) . rand() . '.jpg');
            $icon = Storage::url($path);
            $icon = explode('/storage', $icon)[1];
            $request = $request->except('artPic');
            $request['artPic'] = $icon;
        } else {
            $request = $request->all();
        }
        zgz_artdraft::create($request);
        return redirect('home/art/article');
    }

    //编辑草稿文章
    public function editArt($id)
    {
        $dra = zgz_artdraft::where('id', $id)->get()->toArray()[0];
        $dra['type'] = 0;
        return view('home/art/editArt')->with('dra',$dra);
    }
    //  再一次保存草稿文章
    public function editTowArt(Request $request)
    {
        $req = $request->except('uid','id','_token');
        zgz_artdraft::where('id',$request->id)->update($req);
        return back();
    }
    //草稿文章发布
    public function publishArt(Request $request)
    {
        if ($request->artPic){
            //处理图片地址
            $file = $request->file('artPic');
            $path = $file->move('images/home/article', date(time()) . rand() . '.jpg');
            $icon = Storage::url($path);
            $icon = explode('/storage', $icon)[1];
            $request = $request->except('artPic');
            $request['artPic'] = $icon;
            $result = zgz_article::create($request);
        }else{
            //当没有提交图片时
            $res = zgz_artdraft::find($request->id)->artPic;
            $request = $request->all();
            $request['artPic'] = $res;
            $result = zgz_article::create($request);
        }
        if ($result){
            //如果有返回值删除草稿表里的数据
            zgz_artdraft::where('id',$request['id'])->delete();
            return redirect('home/art/article');
        }else{
            return back();
        }
    }
    //编辑提交文章
    public function newEditArt($id)
    {
        $dra = zgz_article::where('id',$id)->get()->toArray()[0];
        $dra['type'] = 1;
        return view('home/art/editArt')->with('dra',$dra);
    }
    //草稿文章删除
    public function detArt($id)
    {
        zgz_artdraft::find($id)->delete();
        return back();
    }

    //删除发布文章
    public function deleteArt($id)
    {
        zgz_article::find($id)->delete();
        return back();
    }
}
