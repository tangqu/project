<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * 前台登录注册
 */
Route::get('/reg','Home\UserController@regForm');
Route::post('/doReg','Home\UserController@doReg');
Route::post('regPhone','Home\UserController@regPhone');
Route::post('regName','Home\UserController@regName');
//手机发送验证码路由
Route::get('sendSms','Home\UserController@sendSms');

Route::get('login','Home\UserController@loginForm');
Route::post('doLogin','Home\UserController@doLogin');
Route::get('loginCode','Home\UserController@loginCode');
Route::get('logout','Home\UserController@logout');
// Route::get('/admin/list',function(){
//     echo 1;
// });
/*
|--------------------------------------------------------------------------
| 网站前台
|--------------------------------------------------------------------------
|
| prefix:分组
| 		user组 picture组 article组
| namespace:控制器选择区域
|		
| middleware:中间键选择
|		登录、注册、首页、详情页、瀑布流展示页、分类显示页
*/
Route::group(['prefix' => 'home','namespace'=>'Home'],function(){
    
    //user组
    Route::group(['prefix' => 'user'],function(){
    	Route::get('person','UserController@perCenter');
        Route::get('infoEdit','InfoController@infoEdit');
    });
    //图片组
    Route::group(['prefix' => 'pic'],function(){
        Route::get('pictrue','PicController@index');
    });
    //文章组
    Route::group(['prefix' => 'art'],function(){

    });

});

Route::group(['prefix' => 'admin','namespace'=>'Admin'],function(){

    //后台首页
    Route::get('index','AdminController@index');
    //管理员账号密码修改、退出
    Route::get('editPass','AdminController@editPass');

    //管理员权限管理
    

    //后台用户管理
    Route::group(['prefix' => 'user'],function(){
        //用户列表
        Route::get('list','UserManageController@list');

        //用户添加
        Route::get('add','UserManageController@add');
        Route::post('doAdd','UserManageController@doAdd');

        //用户修改
        Route::get('update','UserManageController@update');
        Route::post('doUpadte','UserManageController@doUpadte');

        //用户删除
        Route::get('delete','UserManageController@delete'); 
    });
    

});


