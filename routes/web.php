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

Route::get('/','Home\WelController@welcome');

Route::get('/getPic/{page?}','Home\WelController@pbl');


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

Route::group(['prefix'=>'comUser','namespace'=>'Home'],function(){
    //进入图片详情页
    Route::get('delate/{id?}','WelController@delate');
    //进入更多专辑页
    Route::get('moreAlbum','WelController@moreAlbum');
    //一级分类查询
    Route::get('cateFirst','CategoryController@cateFirst');
    //分类查询
    Route::get('cateList/{id?}/{cateName?}','CategoryController@cateList');
    //三级分类查询
    Route::get('thirdSel','CategoryController@thirdSel');
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
Route::group(['prefix' => 'home','namespace'=>'Home','middleware' => 'checkHome.login'],function(){
    
    //user组
    Route::group(['prefix' => 'user'],function(){
    	Route::get('person/{id?}','UserController@perCenter');
        //个人中心信息
        Route::get('infoEdit','InfoController@infoEdit');
        Route::post('doInfo','InfoController@infoUpdate');
        Route::post('emailUpdate','InfoController@emailUpdate');
        Route::post('passEdit','InfoController@passEdit');
        Route::get('address','InfoController@address');
        //地址
        Route::post('address_add','AddressController@addressAdd');
        Route::any('address_update','AddressController@addressUpdate');
        Route::get('address_del/{id}','AddressController@addressDel');
    });
    //用户地址组
    Route::group(['prefix'=>'userAddr'],function(){
        Route::get('edit','AddressController@edit');
        Route::post('doEdit','AddressController@doEdit');
    });
    
    //文章组
    Route::group(['prefix' => 'art'],function(){
         //文章首页
        Route::get('article','articleControllers@index');
        Route::get('articleTwo','articleControllers@articleTwo');
        //文章展示页
        Route::get('listArt/{id}','articleControllers@listArt');
        //写文章页面
        Route::get('wrArt','wrArtControllers@wrArt');
        //发布文章
        Route::post('publish','wrArtControllers@publish');
        //个人中心获取用户文章信息
        Route::get('pushArt','articleControllers@pushArt');
        //保存文章
        Route::post('draft','wrArtControllers@draft');
        //编辑草稿文章
        Route::get('editArt/{id}','wrArtControllers@editArt');
        //在次保存草稿文章
        Route::post('editTowArt','wrArtControllers@editTowArt');
        //草稿文章发布
        Route::post('publishArt','wrArtControllers@publishArt');
        //草稿文章删除
        Route::get('detArt/{id}','wrArtControllers@detArt');
        //编辑文章
        Route::get('newEditArt/{id}','wrArtControllers@newEditArt');
        //删除发布文章
        Route::get('deleteArt/{id}','wrArtControllers@deleteArt');
        //评论文章
        Route::post('artComment','artCommentController@artComment');
        //文章点赞
        Route::get('artPraises','artPraisesController@artPraises');
        //文章收藏
        Route::get('artCollect','artCollectController@artCollect');
        //回复评论
        Route::post('artReply','replyController@artReply');
        //瀑布流展示文章
        Route::get('artsh','articleControllers@artsh');
        //文章展示页面
        Route::get('artshow','articleControllers@artshow');
    });

    //前台用户专辑管理
    Route::group(['prefix' => 'album'],function(){
        //添加专辑
        Route::post('add','AlbumController@add');
        //修改专辑
        Route::post('update','AlbumController@update');
        //删除专辑
        Route::get('delete/{id?}/{uid?}','AlbumController@delete');
        //专辑下图片显示
        Route::get('picList/{id?}','AlbumController@picList');
    });

    //前台图片管理
    Route::group(['prefix' => 'picture'],function(){

        //查看用户专辑
        Route::get('userAlbum','pictureController@userAlbum');
        //图片上传
        Route::post('uploadImg','pictureController@uploadImg');
        //图片删除
        Route::get('delete/{id?}','pictureController@delete');
        //查看图片
        Route::get('pushPic','pictureController@pushPic');
        //图片点赞
        Route::get('praiseAdd','picPraiseController@praiseAdd');
        //取消点赞
        Route::get('praiseQx','picPraiseController@praiseQx');
    });

    //前台图片评论管理
    Route::group(['prefix'=>'content'],function(){
        //添加评论
        Route::post('add','picContentController@add');
        //查看图片评论
        Route::get('list','picContentController@list');
        //修改评论
        Route::post('update','picContentController@update');
        //删除评论
        Route::get('delete/{id?}','picContentController@delete');
    });

    //前台评论回复管理
    Route::group(['prefix'=>'picReply'],function(){
        //添加回复
        Route::post('add','picReplyController@add');
        //查看回复
        Route::get('list','picReplyController@list');
        //更新回复
        Route::get('update','picReplyController@update');
        //删除回复
        Route::get('delete/{id?}','picReplyController@delete');
    });
    //前台图片收藏管理
    Route::group(['prefix'=>'picCollect'],function(){
        //添加收藏
        Route::get('add','picCollectController@add');
        //收藏列表
        Route::get('list','picCollectController@list');
        //个人中心查看图片
        Route::get('userList','picCollectController@userList');
        //删除收藏
        Route::get('delete/{id?}','picCollectController@delete');
    });


});

Route::group(['prefix' => 'admin','namespace'=>'Admin'],function(){

    //后台首页
    Route::get('index','AdminController@index');
    //后台管理员登录
    Route::get('login','AdminController@login');
    Route::get('doCode','AdminController@doCode');
    Route::post('doLogin','AdminController@doLogin');
    //管理员账号密码修改、退出
    Route::get('editPass','AdminController@editPass');
    Route::post('doPass','AdminController@doPass');
    Route::get('logout','AdminController@logout');

    //管理员权限管理
    //权限管理
    Route::get('permission-list','PermissionController@permissionList');
    Route::any('permission-Add','PermissionController@permissionAdd');
    Route::any('permission-Update/{permission_id}','PermissionController@permissionUpdate');
    Route::get('permission-Del/{permission_id}','PermissionController@permissionDel');
    //角色管理
    Route::get('role-list','RoleController@roleList');
    Route::any('role-Add','RoleController@roleAdd');
    Route::any('attachPermission/{role_id}','RoleController@attachPermission');
    Route::any('role-Update/{role_id}','RoleController@roleUpdate');
    Route::get('role-Del/{role_id}','RoleController@roleDel');
    //管理员管理
    Route::get('user-list','AdminController@userList');
    Route::any('user-Add','AdminController@userAdd');
    Route::any('user-Update/{user_id}','AdminController@userUpdate');
    Route::any('attachRole/{user_id}','AdminController@attachRole');
    Route::get('user-reset/{user_id}','AdminController@userReset');
    Route::get('user-Del/{user_id}','AdminController@userDel');
    

    //后台用户管理
    Route::group(['prefix' => 'user'],function(){
        //用户列表
        Route::any('list','UserManageController@list');

        //用户状态
        Route::get('userStutas/{id}','UserManageController@userStutas');

        //用户添加
        Route::get('add','UserManageController@add');
        Route::post('doAdd','UserManageController@doAdd');

        //用户验证
        Route::post('userName','UserManageController@userName');
        Route::post('password','UserManageController@password');
        Route::post('phone','UserManageController@phone');
        Route::post('email','UserManageController@email');

        //用户修改
        Route::get('update/{id}','UserManageController@update');
        Route::post('doUpadte','UserManageController@doUpadte');

        //用户删除
        Route::get('delete/{id}','UserManageController@delete');

        //用户详情页
        Route::get('detail/{id}','UserManageController@detail');
    });

    //后台分类管理
    Route::group(['prefix' => 'category'],function(){
        //显示分类列表
        Route::get('list/{pid?}','CategoryController@list');
        //添加分类
        Route::get('add/{id?}/{pid?}','CategoryController@add');
        Route::post('doAdd','CategoryController@doAdd');
  
        //修改分类
        Route::get('update/{id?}','CategoryController@update');
        Route::post('doUpdate','CategoryController@doUpdate');
        //删除分类
        Route::get('delete/{id?}','CategoryController@delete');

        //修改分类显示隐藏
        Route::get('disEdit/{id?}/{display?}','CategoryController@disEdit');
    });

    //后台专辑管理
    Route::group(['prefix' =>'album'],function(){
        //显示用户专辑列表
        Route::any('userList','AlbumController@userList');   
        //显示对应用户专辑
        Route::get('albumList/{id?}','AlbumController@albumList');
        //显示专辑下图片
        Route::get('picList/{id?}','AlbumController@picList');
    });

    //后台图片管理
    Route::group(['prefix' =>'picture'],function(){
        //进入图片管理页
        Route::get('manager/{id?}','PictureController@manager');
        //图片进入待审核
        Route::get('sh/{id?}','PictureController@sh');
        //图片通过
        Route::get('yes/{id?}','PictureController@yes');
        //图片未通过
        Route::get('no/{id?}','PictureController@no');
        //图片删除
        Route::get('delete/{id?}','PictureController@delete');
    });

    //文章组
    Route::group(['prefix' => 'art'],function(){
        //用户文章列表
        Route::get('article','ArticleController@article');
        //文章详情页
        Route::get('artDetail/{id}','ArticleController@artDetail');

        //审核通过
        Route::get('artStatus/{id}','ArticleController@artStatus');
        //审核不通过
        Route::get('artNot/{id}','ArticleController@artNot');
        //重新审核
        Route::get('artAgain/{id}','ArticleController@artAgain');

        //文章管理
        Route::get('artManage','ArticleController@artManage');
        //显示通过的文章
        Route::get('status','ArticleController@status');
        //显示未通过的文章
        Route::get('Nopass','ArticleController@Nopass');
        //文章评论管理
        Route::get('reviews','ArticleController@reviews');
        //回复评论
        Route::get('reply/{id}','ArticleController@reply');
        Route::get('redel/{id}','ArticleController@redel');

    });
    

});


