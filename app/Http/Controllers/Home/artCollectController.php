<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_artCollect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class artCollectController extends Controller
{
    //文章收藏
    public function artCollect(Request $request)
    {
        $coll =[
            'uid'=> Auth::user()->id,
            'tid'=> $request->tid
        ];
        $url = zgz_artCollect::where($coll)->first();
        if($url){
            $reu = zgz_artCollect::where('id',$url->id)->delete();
            return $reu;
        }else{
            $reu =  zgz_artCollect::create($coll);
            return $reu;
        }
    }
}
