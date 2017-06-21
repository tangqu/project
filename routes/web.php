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
Route::group(['prefix' => 'home','namespace' => 'Home'],function(){
    
    //user组
    Route::group(['prefix' => 'user'],function(){
    	Route::get('person','UserController@perCenter');
    });
    //图片组
    Route::group(['prefix' => 'pic'],function(){

    });
    //文章组
    Route::group(['prefix' => 'art'],function(){

    });

});


