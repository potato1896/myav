@extends('layouts.master')
@section('title')
   {{$column}}_{{$movies->title}}
@endsection
@section('link')
    <script src="http://www.jq22.com/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css')}}">
    <script src="{{ URL::asset('js/jquery.magnific-popup.min.js')}}"></script>

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
        <p>
           <h4> 发行日期：{{$movies->releasedate}}</h4>
        </p>
        <p>
        <h4> 长度：{{$movies->releasedate}}</h4>
        </p>
        <p>
        <h4> 导演：{{$movies->director}}</h4>
        </p>
        <p>
        <h4> 制作商：{{$movies->studio}}</h4>
        </p>
        <p>
        <h4> 发行商：{{$movies->label}}</h4>
        </p>
        <p>
        <h4> 系列：{{$movies->series}}</h4>
        </p>
        <p>
        <h4> 标签：{{$movies->catalog}}</h4>
        </p>
        <p>
        <h4> 演员：{{$movies->actor}}</h4>
        </p>


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

    @if(isset($movies->hasmag))

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
                            <td><h4><a href="{{$mag->content}}">{{$mag->name}}</a></h4></td>
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

                @foreach($movies2 as $mov)
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">

                                <a title="{{$mov->title}}" data-title="{{$mov->title}}"  href="/content/show/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>


@endsection
