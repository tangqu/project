<?php

namespace App\Http\Controllers\Home;

use App\Models\zgz_address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //添加地址
    public function addressAdd(Request $request)
    {
        zgz_address::create($request->all());
        return back();
    }

    //编辑地址
    public function edit(Request $request)
    {
        $res = zgz_address::where('id',$request['id'])->first();
        return $res;
    }
    //修改地址
    public function doEdit(Request $request)
    {
        $res = $request->except(['_token','id']);
        $result = zgz_address::where('id',$request->id)->update($res);
        return back();
    }

    //删除地址
    public function addressDel($id)
    {
        zgz_address::find($id)->delete();
        return back();
    }
}
