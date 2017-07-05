<div id="dt-header-right">
    <div id="dt-ologin" class="dt-has-menu dropdown">
        <div class="dt-ologin-icons dropdown-toggle" data-toggle="dropdown">

            <a class="for-phone">我的享趣</a>
            <i></i>
            <!-- <div class="dt-menu">
                <a href="/app/duitang/">
                <img src="https://b-ssl.duitang.com/uploads/people/201605/23/20160523122327_BZEyW.png">
                <p>扫一扫下载手机客户端</p>
                </a>
            </div> -->

        </div>
        <ul class="dropdown-menu">
            <li><a href="{{url('/home/user/person')}}/{{Auth::user()->id}}">个人首页</a></li>
            <li><a href="{{url('/home/user/infoEdit')}}">账户设置</a></li>
            <li class="divider"></li>
            <li><a href="{{url('logout')}}">退出</a></li>
        </ul>
    </div>
    <div class="dt-vline"></div>
    <!-- 登录按钮 -->
    <a id="dt-login" class="dt-head-cat" href="#" >消息</a>
    <div class="dt-vline"></div>
    <!-- 注册按钮 -->
    <a id="dt-register" class="dt-btn dt-head-cat" href="#">动态</a>
    <div class="dt-vline"></div>
    <!-- 其他部分 -->
    <div class="dt-has-menu dt-head-cat">
        <a class="dt-dreamer-a" href="{{url('/home/art/article')}}">享趣生活馆</a>
        <span class="dt-dreamer">new</span>
    </div>
    <div class="dt-vline"></div>
    <div class="dropdown dt-head-cat gn " style="margin-top:15px">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">享趣吧!!
       </button>
        <ul class="dropdown-menu">
          <li id="upload-Img-Btn1"><a href="javascrip:void(0);" >上传图片</a></li>
          <li id="addAlbum1"><a href="javascrip:void(0);">创建专辑</a></li>
          <li class="divider"></li>
          <li><a href="{{url('/home/art/wrArt')}}">创建文章</a></li>
        </ul>
    </div>
    <!-- <a id="dt-login" class="dt-head-cat" href="#" >享趣吧!!</a> -->
</div>