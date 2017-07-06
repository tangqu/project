<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_artPraises;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class artPraisesController extends Controller
{
    public function artPraises(Request $request)
    {
        $pra =[
                'uid'=> Auth::user()->id,
                'tid'=> $request->tid
                ];
//        dd($pra);
        $url = zgz_artPraises::where($pra)->first();
        if($url){
            $reu = zgz_artPraises::where('id',$url->id)->delete();
            return $reu;
        }else{
            $reu =  zgz_artPraises::create($pra);
            return $reu;
         }
    }

}
