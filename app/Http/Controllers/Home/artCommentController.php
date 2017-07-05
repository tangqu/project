<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_artComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;

class artCommentController extends Controller
{
    public function artComment(Request $request)
    {
//        return $request->uid;
       $u = zgz_artComment::create($request->all());
        return $u;
    }
}
