@extends('layouts.master')
@section('title')
    @if($column==1)
        磁力AV
    @else
        在线视频
    @endif
    _{{$catalog}}
@endsection
@section('link')
    <link rel="stylesheet" href="{{ URL::asset('css/simplelightbox.min.css') }}">

    <script src="{{ URL::asset('js/simple-lightbox.min.js') }}"></script>

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

                @endif
                <a href="/rand/{{$column}}/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
               </div>
            <div class="row">


                @foreach($movies as $mov)
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">
                            @if($column==1)
                                <a href="/content/show/{{$mov->id}}"> <img alt="{{$mov->title}}" height="250px" src="{{$mov->thumbnail}}" /></a>
                            @else
                            <a href="/content/play/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>


        </div>


    </div>
@endsection
