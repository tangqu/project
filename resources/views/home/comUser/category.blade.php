@extends('layouts.master')
	
@section('css')

	<link rel="stylesheet" type="text/css" href="/css/home/pbl.css">
	<style>
		.cateArea{
			width:1200px;height:112px;border:1px solid #ccc;margin:0 auto
		}
		.cateArea-first{
			width:222px;height:112px;text-align:center;font:20px/112px '黑体';float:left;border-right:1px solid #ccc;
		}
		.cateArea-third{
			width:970px;height:112px;text-align:center;font:14px/112px '黑体';float:left;
		}
		.gn{
			margin-top: 0px !important;
		}
	</style>
@endsection


@section('content')

	<div class="cateArea clearfix">
		<div class="cateArea-first">
			{{$cate}}
		</div>
		<div class="cateArea-third">
			@if($thirdCate)
				@foreach($thirdCate as $res)
					<span style="margin-left:10px;color:#B5B5B5;cursor: pointer;" onclick=thirdSel({{$res['id']}})>{{$res['cateName']}}</span>
				@endforeach
			@endif
		</div>
	</div>
	<div style="width:1200px;height:52px;margin:10px auto 10px;border-bottom:1px solid #ccc;padding-top:10px">
		<div >图片分类显示</div>
	</div>

	<div style="width:1200px;margin:10px auto;min-height:500px" class="clearfix" id="thirdCatePic">
	@if($catePic)
		@foreach($catePic as $res)
			<div class="grid" style="height:240px">
				
				<div class="imgholder">
					<a href="{{url('/comUser/delate')}}/{{$res['id']}}" title=""><img src="{{url($res['picName'])}}" /></a>
				</div>
				<strong>{{$res['picDesc']}}</strong>
				<p>...</p>
				<div class="meta">点击图片查看详情</div>

			</div>
		@endforeach
	@endif
	</div>
    
@endsection

@section('js')
	<script src="/js/com/jquery.tmpl.js"></script>
	 <script type="text/html" id="thirdPicInfo">
       <div class="grid" style="height:240px">
                
            <div class="imgholder">
                <a href="{{url('/comUser/delate')}}/${id}" title=""><img src="{{url('/')}}/${picName}" /></a>
            </div>
            <strong>${picDesc}</strong>
            <p>...</p>
            <div class="meta" >点击图片查看详情</div>

        </div>
    </script>
	<script>
		function thirdSel($id){
			$('#thirdCatePic').empty();
			var cid = $id;
			$.ajax({
				url:'/comUser/thirdSel',
				type:'get',
				data:{cid:cid},
				success:function(data){
					$("#thirdPicInfo").tmpl(data).prependTo("#thirdCatePic");
				}
			})
		}
	</script>
@endsection





