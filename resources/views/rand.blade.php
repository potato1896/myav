@extends('layouts.master2')
@section('title')
    @if($column==1)
        磁力AV
    @elseif($column==2)
        在线视频
    @elseif($column==3)
        欧美靓女
    @endif
    _{{$catalog}}_随机
@endsection
@section('link')
    <style>
        .loadEffect{
            width: 100px;
            height: 100px;
            position: relative;
            margin: 0 auto;
            margin-top:100px;
        }
        .loadEffect span{
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: lightgreen;
            position: absolute;
            -webkit-animation: load 1.04s ease infinite;
        }
        @-webkit-keyframes load{
            0%{
                opacity: 1;
            }
            100%{
                opacity: 0.2;
            }
        }
        .loadEffect span:nth-child(1){
            left: 0;
            top: 50%;
            margin-top:-8px;
            -webkit-animation-delay:0.13s;
        }
        .loadEffect span:nth-child(2){
            left: 14px;
            top: 14px;
            -webkit-animation-delay:0.26s;
        }
        .loadEffect span:nth-child(3){
            left: 50%;
            top: 0;
            margin-left: -8px;
            -webkit-animation-delay:0.39s;
        }
        .loadEffect span:nth-child(4){
            top: 14px;
            right:14px;
            -webkit-animation-delay:0.52s;
        }
        .loadEffect span:nth-child(5){
            right: 0;
            top: 50%;
            margin-top:-8px;
            -webkit-animation-delay:0.65s;
        }
        .loadEffect span:nth-child(6){
            right: 14px;
            bottom:14px;
            -webkit-animation-delay:0.78s;
        }
        .loadEffect span:nth-child(7){
            bottom: 0;
            left: 50%;
            margin-left: -8px;
            -webkit-animation-delay:0.91s;
        }
        .loadEffect span:nth-child(8){
            bottom: 14px;
            left: 14px;
            -webkit-animation-delay:1.04s;
        }
    </style>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row">
                @if($column==1)
                    <div class="btn-group">
                        @if($catalog=='有码')
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                {{$catalog}} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/magnet/uncensored">无码</a></li>
                                <li><a href="/magnet/west">欧美</a></li>

                            </ul>
                        @elseif($catalog=='无码')
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                {{$catalog}} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/magnet/censored">有码</a></li>
                                <li><a href="/magnet/west">欧美</a></li>

                            </ul>
                        @else
                            <button type="button" class="btn btn-default dropdown-toggle"
                                    data-toggle="dropdown">
                                {{$catalog}} <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/magnet/censored">有码</a></li>
                                <li><a href="/magnet/uncensored">无码</a></li>

                            </ul>


                        @endif
                    </div>

                @elseif($column==2)
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            {{$catalog}} <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            @for($i=0;$i<count($catalogs) ;$i++)
                                @if($catalogs[$i]!=$catalog)
                                    <li><a href="/videolist/{{$catalogs[$i]}}">{{$catalogs[$i]}}</a></li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                @elseif($column==3)
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            {{$catalog}} <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu" role="menu">
                            @for($i=0;$i<count($catalogs) ;$i++)
                                @if($catalogs[$i]!=$catalog)
                                    <li><a href="/piclist/{{$catalogs[$i]}}">{{$catalogs[$i]}}</a></li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                @endif
                <a href="/rand/{{$column}}/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
               </div>
            <div class="row">

                <div class="waterfalls">
                    @foreach($movies as $mov)
                        <div class="box">

                            <div class="pic">

                                @if($column==1)
                                    <a href="/content/show/{{$mov->id}}"> <img alt="{{$mov->title}}" height="250px" src="{{$mov->thumbnail}}" /></a>
                                @elseif($column==2)
                                    <a href="/content/play/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>
                                @elseif($column==3)
                                    <a href="/pic/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>

                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="loadEffect" style="display: none">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
<script>

    function ScollTop() { //滚动条位置
        var t;
        if (document.documentElement && document.documentElement.scrollTop) {
            t = document.documentElement.scrollTop;
        } else if (document.body) {
            t = document.body.scrollTop;
        }
        return t;
    }
    function ScollHeight() { //滚动条位置
        var h;
        if(document.documentElement && document.documentElement.scrollTop) {
            h = document.documentElement.scrollHeight;
        } else if(document.body) {
            h = document.body.scrollHeight;
        }
        return h;
    }

    function ClientHeight() {
      var clientHeight = 0;
            if(document.body.clientHeight && document.documentElement.clientHeight) {
                 clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight);
             } else {
             clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight);
            }
            return clientHeight;
       }

    $(document).ready(function(){
        $(window).scroll(function() {
            if(ClientHeight()+ScollTop()== ScollHeight() ||window.pageYOffset + window.innerHeight >= document.documentElement.scrollHeight)
            {
                $('.loadEffect').show();
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "/ajaxrand/{{$column}}/{{$catalog}}",

                }).done(function( response ) {
                    $('.loadEffect').hide();

                    $.each(response,function(key,value){  //遍历键值对
                        var id=value["id"],pic=value['thumbnail'],title=value['title'];
                 $('.waterfalls').append('<div class="box"><div class="pic"><a href="/content/play/'+id+'" ><img  alt="'+title+'"   src="'+pic+'" /></a></div></div>')

                    })
                    })
                    .fail(function( response ) {
                        console.log( "Error: " + response );
                    });
            }
        });
    });

</script>

            </div>


        </div>


    </div>
@endsection
