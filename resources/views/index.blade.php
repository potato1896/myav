@extends('layouts.master')
@section('title', '首页')
@section('link')
    <style>
        * {

            margin: 0;

            padding: 0;

        }

        .waterfalls {
            padding:10px;
            position: relative;
            margin: 0 auto;
            column-gap: 20px; /* 每列的距离，不设置这个可以通过margin来设置边距 */
        }
        .waterfalls2 {
            padding:10px;
            position: relative;
            margin: 0 auto;
            column-gap: 20px; /* 每列的距离，不设置这个可以通过margin来设置边距 */
        }
        .waterfalls3 {
            padding:10px;
            position: relative;
            margin: 0 auto;
            column-gap: 20px; /* 每列的距离，不设置这个可以通过margin来设置边距 */
        }
        .box {
            break-inside: avoid; /* 这个是设置多列布局页面下的内容盒子如何中断，如果不加上这个，每列的头个元素就不会置顶，配合columns使用 */
            margin-bottom:15px;
            color:white;
            border-radius:5px;
        }

        .pic img {
            width: 100%; /* 建议每个图片宽高为100%，如果不设置宽高，就会溢出外层盒子的，或者设置固定宽度，最好不要宽过外层盒子或者高过外层盒子。这里说的外层盒子就是 html 代码里的 .box */
            height: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        @media (min-width: 992px) {
            .waterfalls {
                column-count: 4;
            }
            .waterfalls2 {
                column-count: 6;
            }
            .waterfalls3 {
                column-count: 5;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .waterfalls {
                column-count: 2;
            }
            .waterfalls2 {
                column-count: 2;
            }
            .waterfalls3 {
                column-count: 2;
            }
        }
        @media (max-width: 767px) {
            .waterfalls {
                column-count: 1;
            }
            .waterfalls2 {
                column-count: 2;
            }
            .waterfalls3 {
                column-count: 1;
            }
        }

    </style>
@endsection

@section('content')

    <div class="row clearfix" style="margin-top:100px;">

            <a href="/magnet/all"><button type="button" class="btn btn-default btn-inverse active">磁力AV</button></a>
            <a href="/magnet/censored"><button type="button" class="btn btn-default btn-inverse active">有码</button></a>
            <a href="/magnet/uncensored"><button type="button" class="btn btn-default btn-inverse active">无码</button></a>
            <a href="/magnet/west"><button type="button" class="btn btn-default btn-inverse active">欧美</button></a>
    </div>
    <div class="row clearfix">

        <div class="waterfalls2">
            @foreach($movies as $mov)
                <div class="box">
                    <div class="pic">
                         <a href="/content/show/{{$mov->id}}"><img src="{!! URL::asset($mov->thumbnail)!!}" /></a>
                        <p style="margin-top: 10px">
                            @if($mov->hashd==1)
                                <button class="btn btn-xs btn-primary" disabled="disabled" title="包含字幕的磁力連結">高清</button>

                            @endif

                            @if($mov->hassub==1)
                                <button class="btn btn-xs btn-warning" disabled="disabled" title="包含字幕的磁力連結">字幕</button>
                            @endif
                            <span>{{$mov->designation}}</span>
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="row clearfix">
        <a href="/videolist/全部"><button type="button" class="btn btn-default btn-inverse active">在线视频</button></a>

    @foreach($videocatalog as $cata)
            <a href="/videolist/{{$cata}}"><button type="button" class="btn btn-default btn-inverse active">{{$cata}}</button></a>
        @endforeach

    </div>
    <div class="row clearfix">
        <div class="waterfalls">
            @foreach($videos as $mov)
                <div class="box">
                    <div class="pic">
                           <a href="/content/play/{{$mov->id}}"><img src="{{$mov->thumbnail}}" /></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row clearfix">
                <a href="/piclist/all"><button type="button" class="btn btn-default btn-inverse active">欧美靓女</button></a>
                @foreach($picatalog as $cata)
                    <a href="/rand/3/{{$cata}}"><button type="button" class="btn btn-default btn-inverse active">{{$cata}}</button></a>
                @endforeach
    </div>
    <div class="row clearfix">

        <div class="waterfalls3">
            @foreach($pics as $mov)
                <div class="box">
                    <div class="pic">
                        <a href="/pic/{{$mov->id}}"><img src="{{$mov->thumbnail}}" /></a>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection
