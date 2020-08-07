@extends('layouts.master')
@section('title')
    {{$actor->name}}
@endsection
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

        .box {

            break-inside: avoid; /* 这个是设置多列布局页面下的内容盒子如何中断，如果不加上这个，每列的头个元素就不会置顶，配合columns使用 */

            margin-bottom:15px;

            /* 如果是非图片瀑布流的话就加上背景吧，不然感觉不太好看。 */

            /* background:dodgerblue; */

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

@section('content')
    <div class="row clearfix" style="margin-top:100px;">

    </div>
    <div class="row">
        <div class="waterfalls" style="">
            <div class="box">
                <div class="pic">
                     <img src="{{$actor->thumbnail}}" />
                    <p>
                        <h4>{{$actor->name}}</h4>
                    </p>
                </div>

            </div>
            @foreach($result as $res)
                <div class="box">
                    <div class="pic">
                    <a title="{{$res['title']}}" href="/content/show/{{$res['id']}}"> <img src="{{$res['thumbnail']}}" /></a>
                    </div>

            </div>
        @endforeach
        </div>
    </div>
    <div class="row">  {!! $paginator->render() !!}</div>
@endsection
