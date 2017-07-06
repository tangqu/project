<?php

namespace App\Http\Controllers\Admin;

use App\Models\zgz_artComment;
use App\Models\zgz_article;
use App\Models\zgz_artView;
use App\Models\zgz_reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //用户文章列表
    public function article()
    {
        //在数据库查询相关数据 并且分页
        $req = DB::table('zgz_articles')
            ->join('zgz_users', 'zgz_users.id', '=', 'zgz_articles.uid')
            ->select('zgz_articles.*', 'zgz_users.userName')
            ->paginate(3);
        return view('admin.art.article',['req'=> $req]);
    }

    //文章详情页面
    public function artDetail($id){
        //在数据库查询相关数据
        $det = DB::table('zgz_articles')
            ->join('zgz_users', 'zgz_users.id', '=', 'zgz_articles.uid')
            ->select('zgz_articles.*', 'zgz_users.userName')
            ->where('zgz_articles.id',$id)
            ->get()->toArray()[0];
        return view('admin.art.artDetail')->with('det',$det);
    }

    //审核通过
    public function artStatus($id){
        $sta = zgz_article::where('id',$id)->update(['detector'=>2]);
        zgz_artView::insert(['tid'=>$id,'views'=>1]);
        return back();
    }

    //审核不通过
    public function artNot($id){
        $sta = zgz_article::where('id',$id)->update(['detector'=>0]);
        return back();
    }

    //重新审核
    public function artAgain($id){
        $sta = zgz_article::where('id',$id)->update(['detector'=>1]);
        return back();
    }

    //文章管理页面
    public function artManage(){
        //查找未审核的文章
        $manage = zgz_article::where('detector','=','1')->paginate(3);
        return view('admin.art.artManage')->with('manage',$manage);
    }
    //显示已通过文章
    public function Status(){
        //查找通过的文章
        $manage = zgz_article::where('detector','=','2')->paginate(3);
        return view('admin.art.status')->with('manage',$manage);
    }

    //显示未通过文章
    public function Nopass(){
        //查找未通过的文章
        $manage = zgz_article::where('detector','=','0')->paginate(3);
        return view('admin.art.Nopass')->with('manage',$manage);
    }

    //文章评论
    public function reviews(){
        $rev = zgz_artComment::paginate(8);
        return view('admin.art.reviews')->with('rev',$rev);
    }

    public function reply($id){
        $rep = zgz_reply::where('cid',$id)->paginate(8);
        return view('admin.art.reply')->with('rep',$rep);
    }
    public function redel($id){
        $rep = zgz_artComment::where('id',$id)->delete();
        return back();
    }
}
