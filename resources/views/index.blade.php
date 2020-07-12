@extends('layouts.master')
@section('title', '首页')

@section('content')

    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
             <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            磁力AV <span class="caret"></span>
                        </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/magnet/censored">有码</a></li>
                        <li><a href="/magnet/uncensored">无码</a></li>
                        <li><a href="/magnet/west">欧美</a></li>

                    </ul>
             </div>
        </div>
    </div>
    <div class="row clearfix">
        @foreach($movies as $mov)
            <div class="col-md-2 col-xs-6">
                <div class="thumbnail">
                    <a href="/content/show/{{$mov->id}}"> <img src="{{$mov->thumbnail}}" /></a>

                </div>

            </div>
        @endforeach
    </div>
    <div class="row clearfix">
        <a href="/videolist/全部"><button type="button" class="btn btn-default btn-inverse active">在线视频</button></a>

    @foreach($videocatalog as $cata)
            <a href="/videolist/{{$cata}}"><button type="button" class="btn btn-default btn-inverse active">{{$cata}}</button></a>
        @endforeach

    </div>
    <div class="row clearfix">
                @foreach($videos as $mov)
                    <div class="col-md-3">
                        <div class="thumbnail">
                           <a href="/content/play/{{$mov->id}}"><img width="250" height="170" src="{{$mov->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach

    </div>
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div class="row">
                <a href="/piclist/all"><button type="button" class="btn btn-default btn-inverse active">欧美靓女</button></a>
                @foreach($picatalog as $cata)
                    <a href="/piclist/{{$cata}}"><button type="button" class="btn btn-default btn-inverse active">{{$cata}}</button></a>
                @endforeach
            </div>
            <div class="row">


                @foreach($pics as $mov)
                    <div class="col-md-3">
                        <div  class="thumbnail">
                           <a href="/pic/{{$mov->id}}"><img src="{!! URL::asset($mov->thumbnail)!!}" /></a>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

    </div>
@endsection
