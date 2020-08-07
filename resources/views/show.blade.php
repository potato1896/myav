@extends('layouts.master')
@section('title')
   {{$movies->title}}
@endsection
@section('link')

    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css')}}">
    <script src="{{ URL::asset('js/jquery.magnific-popup.min.js')}}"></script>
    <style>
        * {

            margin: 0;

            padding: 0;

        }

        .waterfalls {

            padding:10px;

            position: relative;

            margin: 0 auto;
            columns:170px;

            /* 每列每个元素最小的宽度 */

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
    </style>
@endsection
@section('content')



    <div class="row clearfix">
    <div class="col-md-8 column" style="margin-top:100px;">
      <a href="{{$movies->bigimg}}" id="bigImage"><img class="img-rounded" width="100%" src="{{$movies->bigimg}}"></a>

    </div>

    <div class="col-md-4 column" style="margin-top:100px;">

        <h3>{{$movies->title}}</h3>
        <p>
        <h4> 番号：<span style="color: red">{{$movies->designation}}</span></h4>
        </p>
        @if(isset($movies->releasedate))
        <p>
           <h4> 发行日期：{{$movies->releasedate}}</h4>
        </p>
        @endif
        @if(isset($movies->length))
        <p>
        <h4> 长度：{{$movies->length}}分钟</h4>
        </p>
        @endif
        @if(isset($movies->director))
        <p>
        <h4> 导演：{{$movies->director}}</h4>
        </p>
        @endif
        @if(isset($movies->studio))
        <p>
        <h4> 制作商：{{$movies->studio}}</h4>
        </p>
        @endif
        @if(isset($movies->label))
        <p>
        <h4> 发行商：{{$movies->label}}</h4>
        </p>
        @endif
        @if(isset($movies->series))
        <p>
        <h4> 系列：{{$movies->series}}</h4>
        </p>
        @endif
        @if(isset($tags))
        <p>
        <h4> 标签：
        @foreach($tags as $tag)
            <a href="/tag/{{$column}}/{{$tag}}">{{$tag}}</a>
            @endforeach
        </h4>
        </p>
        @endif
        <p>
        @if(!\App\StringHelper::checkEmpty($movies->actor))
        <h4> 演员：
      @foreach($stars as $star)
            <a href="/star/{{$star->id}}">{{$star->name}}</a>
            @endforeach
        </h4>
        </p>
        @endif

    </div>
    </div>

@if(isset($bigallery))
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h3>视频截图</h3><p></p>
            <div class="galler">
@foreach($bigallery as $big)
                <a href="{{$big}}"><img src="{{$smallgallery[$loop->index]}}"></a>
@endforeach
            </div>
        </div>
        <script>

            (function($){
                $('#bigImage').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    fixedContentPos: true,
                    mainClass: 'mfp-no-margins mfp-with-zoom',
                    image: {
                        verticalFit: true,
                        titleSrc: function(item) {
                            return "{{$movies->title}}";
                        }
                    },
                    zoom: {
                        enabled: true,
                        duration: 300
                    }
                });

                $('.galler').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,
                        titleSrc: function(item) {
                            return "{{$movies->title}}";
                        }
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function(element) {
                            return element.find('img');
                        }
                    }

                });
            })(jQuery);

        </script>
    </div>
@endif

    @if($movies->hasmag==1)

        <div class="row clearfix">
            <div class="col-md-12 column">

                <div class="table-responsive">
                    <table class="table">
                        <caption><h3>磁力链接</h3></caption>
                        <thead>
                        <tr>
                            <th><h4>名称</h4></th>
                            <th><h4>大小</h4></th>
                            <th><h4>日期</h4></th></tr>
                        </thead>
                        <tbody>
                        @foreach($magnets as $mag)
                         <tr>
                            <td><h4><a href="{{$mag->content}}">{{$mag->name}}
                                        @if($mag->hashd==1)
                                            <button class="btn btn-xs btn-primary" disabled="disabled" title="包含字幕的磁力連結">高清</button>

                                        @endif

                                        @if($mag->hassub==1)
                                            <button class="btn btn-xs btn-warning" disabled="disabled" title="包含字幕的磁力連結">字幕</button>
                                        @endif
                                        @if($mag->has3d==1)
                                            <button class="btn btn-xs btn-warning" disabled="disabled" title="包含3D的磁力連結">3D</button>
                                        @endif
                                    </a></h4></td>
                             <td><h4><a href="{{$mag->content}}">{{$mag->size}}</a></h4></td>
                            <td><h4><a href="{{$mag->content}}">{{$mag->releasedate}}</a></h4></td></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row clearfix">
            <div class="col-md-12 column">
<h3>暂时没有磁力!</h3>
            </div>
        </div>
    @endif


        <div class="row clearfix">
            <div class="row">
            <div class="col-md-12 column">
                <h3>随机推荐</h3>
            </div>
            </div>

            <div class="row">

                <div class="waterfalls" style="column-count: 5;">
                    @foreach($movies2 as $mov)
                        <div class="box">
                            <div class="pic">
                                <a title="{{$mov->title}}" data-title="{{$mov->title}}"  href="/content/show/{{$mov->id}}"> <img  alt="{{$mov->title}}"   src="{{$mov->thumbnail}}" /></a>

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>


@endsection
