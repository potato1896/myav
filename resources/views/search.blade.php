@extends('layouts.master')
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
            /* 每列每个元素最小的宽度 */
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
                column-count: {{$num}};
            }

        }
        @media (min-width: 768px) and (max-width: 991px) {
            .waterfalls {
                column-count: {{$num-2}};
            }

        }
        @media (max-width: 767px) {
            .waterfalls {
                column-count: {{$num-4}};
            }
        }
    </style>
@endsection
@section('title')
    搜索结果
@endsection
@section('content')
    <div class="row clearfix" style="margin-top:100px;">

    </div>
    <div class="row">
        <div>
            <h4> 在<span>【{{$type}}】</span>搜索关键词：<span style="color: red">{{$search}}</span>  总共<span style="color: #ff0000">{{$total}}</span>条结果</h4>
        </div>
        <div class="waterfalls">
            @foreach($result as $mov)
                <div class="box">
                    <div class="pic">
                        <a title="{{$mov->title}}" href="/content/{{$url}}/{{$mov->id}}"> <img alt="{{$mov->title}}"  class="croaw_img" src="{{$mov->thumbnail}}" /></a>

                        <p style="margin-top: 10px">

                            <span>{{$mov->designation}}</span>
                        </p><h4> {!! str_replace($search,'<span style=\'color:red\'>'.$search.'</span>',$mov->title)!!}</h4>
                        @if($type=='磁力AV')
                            <h4>主演：</h4>
                            <h4>所属分类：
                                @if($mov->column==1)
                                    有码磁力
                                @elseif($mov->column==2)
                                    无码磁力
                                @elseif($mov->column==3)
                                    欧美磁力
                                @endif

                            </h4>
                            <h4>番号：{{$mov->designation}}</h4>
                            <h4>发行时间：{{$mov->releasedate}}</h4>

                            @if($mov->hashd==1)
                                <button class="btn btn-xs btn-primary" disabled="disabled" title="包含字幕的磁力連結">高清</button>
                            @endif
                            @if($mov->hassub==1)
                                <button class="btn btn-xs btn-warning" disabled="disabled" title="包含字幕的磁力連結">字幕</button>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="row">  {!! $paginator->render() !!}</div>
@endsection
