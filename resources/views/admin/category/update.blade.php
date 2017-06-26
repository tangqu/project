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
        <i class="fa fa-home"></i> <a href="{{url('/admin/index')}}">首页</a> &raquo; <a href="{{url('/admin/user/list/')}}">分类列表</a> &raquo; 添加分类
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
        <form action="{{url('/admin/category/doUpdate')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th width="120"><i class="require">*</i>分类名：</th>
                    <td>
                        <input type="hidden" name="id" value="{{$cateInfo['id']}}">
                       <input type="text" name='cateName' required value="{{$cateInfo['cateName']}}"></p>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>父级ID：</th>
                    <td>
                        <input type="text" name='pid' readonly value={{$cateInfo['pid']}}>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>添加路径：</th>
                    <td>
                        <input type="text" name='path' readonly value={{$cateInfo['path']}}>
                    </td>
                </tr>
                <tr>
                    <th>显示：</th>
                    <td>
                        <label><input type='radio' name='display' value='1'>显示</label>
                        <label><input type='radio' name='display' value='2' checked>隐藏</label>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection