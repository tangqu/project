@extends('layouts.master')

@section('title', '享趣生活馆')

@section('css')
    <style>
        *{
            margin: 0;
            padding: 0;
        }

        ul{
            width: 1200px;
            margin: 0 auto !important;
        }
        ul .li{
            float: left;
            width: 250px;
            list-style: none;
            margin: 20px;
        }
        ul .li div{
            width: 250px;
            margin-bottom: 20px;
            padding: 10px;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: 2px 2px 10px #919B9C;
        }
        ul .li img{
            width: 100%;
            margin-bottom: 10px;
        }
        ul .li p{
            font-family: "microsoft yahei";
            font-size: 14px;
            word-break:break-word;
        }
        p img{
            width: 20px !important;
        }
        .neirong{
            font-size:14px;
            font-family:Arial, Helvetica, sans-serif;
            color:#909090;
            text-indent:2em;
            font-weight:normal;
        }
        .bt{
            width:100%;
            /*display:block;*/
            line-height:1.5em;
            overflow:visible;
            font-size:16px;
            text-shadow:#f3f3f3 1px 1px 0px, #b2b2b2 1px 2px 0
        }
    </style>
@section('content')

        <ul id="ul1">
            <h2>文章列表:</h2>
            <li class="li"></li>
            <li class="li"></li>
            <li class="li"></li>
            <li class="li"></li>
        </ul>
@endsection
@section('foot')
@endsection
@section('js')
    <script src="/js/home/jquery.waterfall.js"></script>
    {{--<script src="/js/com/jquery-1.8.3.min.js"></script>--}}

    <script>
        window.onload = function() {
            //获取界面节点
            var ul = document.getElementById('ul1');
            var li = document.getElementsByClassName('li');
            var liLen = li.length;
            var page = 1;
            var bool = false;
            //调用接口获取数据
            loadPage();//首次加载
            /**
             * 加载页面的函数
             */
            function loadPage(){
                    $.ajax({
                        url:'artsh',
                        type:'get',
                        data:{},
                        success:function(data){
                            var data = JSON.parse(data);
                            //将数据写入到div中
                            for(var i = 0; i < data.length; i++) {
                                var index = getShort(li);   //查找最短的li
                                //创建新的节点：div>img+p

                                var div = document.createElement('div');

                                div.setAttribute('onclick','artlj('+data[i].id+')');

                                var bt = document.createElement('span');
                                bt.innerText = '标题:';
                                div.appendChild(bt);
                                bt.setAttribute('class','bt');
                                var p = document.createElement('span');
                                p.setAttribute('class','bt');

                                p.innerHTML = data[i].title;//获取文章标题
                                div.appendChild(p);
                                var img = document.createElement('img');
                                img.src = data[i].artPic;//img获取图片地址

                                img.alt = "等着吧..."
                                //根据宽高比计算img的高，为了防止未加载时高度太低影响最短Li的判断
                                img.style.height = data[i].height * (230 / data[i].width) + "px";
                                div.appendChild(img);

                                var con = document.createElement('p');
                                con.innerHTML = data[i].attContent;//p获取图片内容
                                con.setAttribute('class','neirong');
                                div.appendChild(con);
                                //加入到最短的li中
                                li[index].appendChild(div);
                            }
                            bool = true;//加载完成设置开关，用于后面判断是否加载下一页
                        }
                    })

            }

            window.onscroll = function (){
                var index = getShort(li);
                var minLi = li[index];
                var scrollTop = document.documentElement.scrollTop||document.body.scrollTop;

                if(minLi.offsetHeight+minLi.offsetTop<scrollTop+document.documentElement.clientHeight){
                    //开关为开，即上一页加载完成，才能开始加载
                    if(bool){
                        bool = false;
                        page++;
                        loadPage();
                    }
                }
            }

        }
        /**
         * 获取数组中高度最小的索引
         * @param {Object} li 数组
         */
        function getShort(li) {
            var index = 0;
            var liHeight = li[index].offsetHeight;
            for(var i = 0; i < li.length; i++) {
                if(li[i].offsetHeight < liHeight) {
                    index = i;
                    liHeight = li[i].offsetHeight;
                }
            }
            return index;
        }


        function artlj(id){
            window.location.href='/home/art/listArt/'+id;
        }

    </script>
@endsection