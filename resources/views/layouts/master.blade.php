<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta property="wb:webmaster" content="973d669418f79e8b">
		<!-- 标题模板 -->
		<title>@yield('title','享趣,分享生活中有趣的那些事')</title>
		<meta name="description" content="堆糖头像图片专辑,交流最新奇的家居生活图片,给你不断的新鲜感觉,每天都是好心情!">
		<meta name="keywords" content="堆糖类目，家居生活">
		
		
		<link rel="stylesheet" type="text/css" href="/css/com/zgz_init.css">
		<link rel="stylesheet" type="text/css" href="/css/home/zgz_master.css">

		<link rel="stylesheet" type="text/css" href="/css/com/bootstrap.min.css">  
		<script src="/js/com/jquery.min.js"></script>
		<script src="/js/com/bootstrap.min.js"></script>

		<!-- css区域 -->
		@yield('css')

	</head>
	<body>
		<!-- 网站头部 -->
		@section('head')
		<div id="header">
			<div style="width: 100%; height: 65px;">
				<div class="pnav-header SG-posfollow" id='header-fixed'>
					<div class="SG-sidecont">
						<div id="header-wrap">
							<div id="dt-header">
								<div class="dt-wrap">

									<!-- 网站头部 logo -->
									<a id="dt-logo" href="http://www.duitang.com/">堆糖</a>
									<!-- 一级分类区 -->
									<div id="dt-nav">
										<div id="dt-nav-btn-cover"></div>
										<div id="dt-nav-btn">分类 <i></i></div>
										<div id="dt-nav-content-cover"></div>
										<div id="dt-nav-content" class="clr">
											<div id="dt-nav-left"></div>
											<div id="dt-nav-right"></div>
										</div>
										<div id="dt-nav-neck"></div>
									</div>
									<!-- 关键字查询 -->
									<div id="dt-search">
										<form action="/search/">
											<input class="ipt" id="kw" autocomplete="off" name="kw" type="text" placeholder="搜索感兴趣的内容">
											<input id="type" type="hidden" name="type" value="feed">
											<button type="submit">搜索</button>
										</form>
									</div>

									<!-- 头部登录部分 -->
									@if (Auth::check())
										@include('layouts.foot')
									@else
										@include('layouts.login')
									@endif


								</div>
							</div>
							<div id="dt-header-btm"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@show

		<!-- 页面主体 -->
		@yield('content')

		<!-- 网站尾部 -->
		@section('foot')
		<div id="footer" class="footer">
			<div class="footcont">
				<div class="footwrap">
					<div class="dt-footer-frdlk">
						<a href="#">标签集</a>
						<a href="#">帮助中心</a>
						<a href="#">关于我们</a>
						<a href="#">加入我们</a>
						<a href="#">免责声明</a>
						<a href="#">享趣收集工具</a>
					</div>
					<span class="dt-footer-icp">
						©2017 zhuyi1995.xin;xiangqu.com (朱毅、顾鹏、张汉坡) 版权所有。
					</span>
				</div>
			</div>
		</div>
		@show
		

		<!-- js区域 -->
		@yield('js')

	</body>
</html>
