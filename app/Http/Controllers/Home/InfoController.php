<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    //进入编辑个人信息页
    public function infoEdit ()
    {
    	return view('home.user.infoEdit');
    }
}
