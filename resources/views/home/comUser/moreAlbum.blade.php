@extends('layouts.master')
	
@section('css')

<style>
	.pageInfo{text-align:center;}
.pageInfo ul{display:inline-block;}
.pageInfo ul li{font-weight: 700;color:#fff;background-color: #5BA5E8;width:50px;height:36px;border-radius:3px;float:left;margin-left:20px;text-align:center;line-height:36px;display:inline;}
</style>
	
@endsection


@section('content')

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
	                    <p class="album-desc">{{$res['count']}}张图片</p>
	                </div>
	            </a>
	        </div> 
		@endforeach
	</div>
	<div class="pageInfo" style="width:1200px;margin:0 auto;">
        <ul class="clearfix">
            @for ($i = 1; $i <= $album->lastPage(); $i++)
                <a href="{{ $album->url($i) }}"><li>
                    {{ $i }}
                </li></a>
            @endfor
        </ul> 
    </div>
	
    
@endsection

@section('js')
	
@endsection





