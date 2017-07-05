@extends('layouts.master')

@section('my-css')
	<link rel="stylesheet" type="text/css" href="/css/home/zgz_index.css">
	<link rel="stylesheet" type="text/css" href="/css/home/pbl.css">


@section('content')
	<div class='dt-top clearfix'>
		<div id="myCarousel" class="carousel slide dt-top-left">
		    <!-- 轮播（Carousel）指标 -->
		    <ol class="carousel-indicators">
		        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		        <li data-target="#myCarousel" data-slide-to="1"></li>
		        <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>   
		    <!-- 轮播（Carousel）项目 -->
		    <div class="carousel-inner">

		        <div class="item active">
		            <img src="{{url('/picture/home/1.jpeg')}}" alt="First slide">
		            <div class="carousel-caption">标题 1</div>
		        </div>
		        <div class="item">
		            <img src="{{url('/picture/home/2.jpeg')}}" alt="Second slide">
		            <div class="carousel-caption">标题 2</div>
		        </div>
		        <div class="item">
		            <img src="{{url('/picture/home/3.jpeg')}}" alt="Third slide">
		            <div class="carousel-caption">标题 3</div>
		        </div>
		    </div>
		    <!-- 轮播（Carousel）导航 -->
		    <a class="carousel-control left" href="#myCarousel" 
		        data-slide="prev">&lsaquo;
		    </a>
		    <a class="carousel-control right" href="#myCarousel" 
		        data-slide="next">&rsaquo;
		    </a>
		</div>
		<div class="dt-top-right">
			<div class='dt-hot'>
				
			</div>
			<div class="dt-gdload">
				
			</div>
		</div>
	</div>

	<div class="dt-block clearfix">
		<h2 >推荐专辑</h2>
		<!-- <button type="button" class="btn btn-info" id="pg-ttentry">更多专辑>></button> -->
		<div style="padding: 22px 0;font-size: 18px;float: right !important;">
			<a href="{{url('/comUser/moreAlbum')}}" class="btn btn-info">更多专辑>></a>
		</div>
	</div>
	<div class="clearfix" style="width:1200px;margin:0 auto;padding-bottom:10px">
		@foreach($album as $res)
			<div class="dis-float-info">
	            <a href="{{url('/home/album/picList')}}/{{$res['id']}}" >
	                <div class="user-album">
	                    @if($res['picName'] == null)
	                        <img src="{{url('/picture/home/picError.png')}}" alt="">
	                    @else
	                        <img src="{{url($res['picName'])}}" alt="">
	                    @endif
	                    
	                    <p class="album-name">{{$res['albumName']}} by {{$res['userName']}}</p>
	                    <p class="album-desc">{{$res['count']}}张图片 </p>
	                </div>
	            </a>
	        </div> 
		@endforeach
	</div>
	<div class="dt-block clearfix">
		<h2>大家正在逛~~</h2>
		<!-- <button type="button" class="btn btn-info" id="pg-ttentry">更多专辑>></button> -->
		
	</div>
	<div style="width:1200px;margin:0 auto">
		<div id="container" class="clearfix">
			@foreach($allPicInfo as $res)
			<div class="grid">
				
				<div class="imgholder">
					<a href="{{url('/comUser/delate')}}/{{$res['id']}}" title=""><img src="{{url($res['picName'])}}"  height="100px"/></a>
				</div>
				<strong>Sunset Lake</strong>
				<p>A peaceful sunset view...</p>
				<div class="meta">by j osborn</div>

			</div>
			@endforeach

		</div>
	</div>
	
    
@endsection



