<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_reletion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class reletionController extends Controller
{
    public function reletion(Request $request)
    {
        $pra =[
            'uid'=>  Auth::user()->id,
            'to_uid'=> $request->to_uid
        ];
        $url = zgz_reletion::where($pra)->first();
        if($url){
            $reu = zgz_reletion::where('id',$url->id)->delete();
            return $reu;
        }else{
            $reu =  zgz_reletion::create($pra);
            return $reu;
        }
    }
}
