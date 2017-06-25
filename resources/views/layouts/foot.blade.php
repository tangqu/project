<div id="dt-header-right">
    <div id="dt-ologin" class="dt-has-menu dropdown">
        <div class="dt-ologin-icons dropdown-toggle" data-toggle="dropdown">

            <img src="{{url('/picture/home/icon.png')}}" alt="" width='36px' style="border-radius: 50%">

            <a class="for-phone">{{Auth::user()->userName}}</a>
            <i></i>
            <!-- <div class="dt-menu">
                <a href="/app/duitang/">
                <img src="https://b-ssl.duitang.com/uploads/people/201605/23/20160523122327_BZEyW.png">
                <p>扫一扫下载手机客户端</p>
                </a>
            </div> -->

        </div>
        <ul class="dropdown-menu">
            <li><a href="{{url('/home/user/person')}}">个人首页</a></li>
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
        <a class="dt-dreamer-a" href="#">享趣生活馆</a>
        <span class="dt-dreamer">new</span>
    </div>
    <div class="dt-vline"></div>
</div>