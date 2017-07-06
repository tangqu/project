<?php

namespace App\Http\Controllers\Home;

use App\Models\VisitorRegistry;
use App\Models\zgz_artCollect;
use App\Models\zgz_artComment;
use App\Models\zgz_artdraft;
use App\Models\zgz_article;
use App\Models\zgz_artPraises;
use App\Models\zgz_artView;
use App\Models\zgz_reletion;
use App\Models\zgz_reply;
use App\Models\zgz_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Weboap\Visitor\Visitor;

class articleControllers extends Controller
{
    //文章页面
    public function index(){
       $uid = Auth::user()->id;
       $req = zgz_artdraft::where('uid',$uid)->orderBy('updated_at','DESC')->paginate(3);
       return view('home.art.article')->with('req',$req);
    }
    public function articleTwo(){
        $uid = Auth::user()->id;
        $res = zgz_article::where('uid',$uid)->orderBy('updated_at','DESC')->paginate(3);
        return view('home.art.articleTwo')->with('res',$res);
    }
    //文章展示页面
    public function listArt($id){

        $res = zgz_article::where('id',$id)->first();
         if (empty($res)||$res->detector != 2) {
            return view('home/art/article404');
         }

        $view = zgz_artView::where('tid',$id)->get()[0];
        $views = $view->views;
        $views += 1;
        $view = zgz_artView::where('tid',$id)->update(['views'=>$views]);
        $view = zgz_artView::where('tid',$id)->get()[0];


        $reply = zgz_reply::where('tid',$id)->get();
        $uid = $res->uid;
        $user = zgz_user::where('id',$uid)->get()[0];
        $com = zgz_artComment::where("tid",$id)->get();

       if (!empty(Auth::user()->id)){
           $p=[
               'uid'=>Auth::user()->id,
               'tid'=>$id
           ];
           $coll = zgz_artCollect::where($p)->first();
           $pra = zgz_artPraises::where($p)->first();
           $gz = [
               'to_uid' =>$uid,
               'uid'=> Auth::user()->id
           ];
           $rele = zgz_reletion::where($gz)->first();
           return view('home.art.listArt')
                            ->with('res',$res)
                            ->with('user',$user)
                            ->with('com',$com)
                            ->with('pra',$pra)
                            ->with('reply',$reply)
                            ->with('rele',$rele)
                            ->with('coll',$coll)
                            ->with('view',$view)
                            ;
       }else{
           return view('home.art.listArt')->with('res',$res)->with('user',$user)->with('com',$com)->with('reply',$reply)
               ->with('view',$view)
                ;
       }
    }

    //瀑布流展示文章页面
    public function artsh(){
        $show = zgz_article::where('detector',2)->get();
        echo $show;
    }
    public function artshow(){
        return view('home.art.artshow');
    }

    //获取用户文章信息
    public function pushArt(Request $request)
    {
      $res = zgz_article::where('uid',$request['uid'])->get();
      return $res;
    }
}
