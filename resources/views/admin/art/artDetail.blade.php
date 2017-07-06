@extends('app')
@section('my-css')
	<style>
		input{
			line-height: 20px;
		}
	</style>
@endsection
@section('content')

	<!--面包屑导航 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; <a href="{{url('/admin/det/list/')}}">用户列表</a> &raquo; 用户详情
	</div>
	<!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
		<div class="result_content">
			<div class="short_wrap">
				<a href="#"><i class="fa fa-plus"></i>新增文章</a>
				<a href="#"><i class="fa fa-recycle"></i>批量删除</a>
				<a href="#"><i class="fa fa-refresh"></i>更新排序</a>
			</div>
		</div>
	</div>
	<!--结果集标题与导航组件 结束-->
	<div class="result_wrap">
			<table class="add_tab">
				<tbody>
				<tr>
					<th>头像：</th>
					<td>
						<img src="{{url($det->artPic)}}" width='160px'>
					</td>
				</tr>
				<tr>
					<th>用户名：</th>
					<td>
						<p>{{$det->userName}}</p>
					</td>
				</tr>
				<tr>
					<th>标题</th>
					<td>
						<p>{{$det->title}}</p>
					</td>
				</tr>
				<tr>
					<th>内容：</th>
					<td style="word-break:break-all">
						<p>{{$det->attContent}}</p>
					</td>
				</tr>
				<tr>
					<th>文章状态：</th>
					<td>
						<p>{{$det->detector== 1 ? '待审核' : '已审核'}}</p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<input type="button" class="back" onclick="history.go(-1)" value="返回">
					</td>
				</tr>
				</tbody>
			</table>
	</div>
@endsection