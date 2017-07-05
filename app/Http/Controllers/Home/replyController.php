<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_reply;
use App\Models\zgz_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class replyController extends Controller
{
    //回复评论
    public function artReply(Request $request){
        $rep = zgz_reply::create($request->all());
        
        return 1;
    }
}
