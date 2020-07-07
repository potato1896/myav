@extends('layouts.master')
@section('title', '首页')
@section('content')

    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row">
                <button type="button" class="btn btn-default btn-inverse active">磁力AV</button>
                <a href="/magnet/censored"><button type="button" class="btn btn-default btn-inverse active">有码</button></a>
                <a href="/magnet/uncensored"><button type="button" class="btn btn-default btn-inverse active">无码</button></a>
                <a href="/magnet/west"><button type="button" class="btn btn-default btn-inverse active">欧美</button></a>
            </div>
            <div class="row">


                @foreach($movies as $mov)
                <div class="col-md-2">
                    <div class="thumbnail">
                        <a href="/content/{{$mov->id}}"> <img src="{{$mov->thumbnail}}" /></a>

                    </div>

                </div>
                @endforeach
        </div>
        </div>
        <div class="col-md-12 column">
            <div class="row">
                <button type="button" class="btn btn-default btn-inverse active">在线视频</button>
                <a href="/video/sub"><button type="button" class="btn btn-default btn-inverse active">中文字幕</button></a>
                <a href="/video/censored"><button type="button" class="btn btn-default btn-inverse active">有码</button></a>
                <a href="/video/uncensored"><button type="button" class="btn btn-default btn-inverse active">无码</button></a>
                <a href="/video/selfie"><button type="button" class="btn btn-default btn-inverse active">自拍</button></a>
                <a href="/video/west"><button type="button" class="btn btn-default btn-inverse active">欧美</button></a>
                <a href="/video/cartoon"><button type="button" class="btn btn-default btn-inverse active">卡通</button></a>
            </div>
            <div class="row">


                @foreach($videos as $mov)
                    <div class="col-md-3">
                        <div class="thumbnail">
                           <a href="/content/play/{{$mov->id}}"><img width="250" height="170" src="{{$mov->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 column">
            <div class="row">
                <button type="button" class="btn btn-default btn-inverse active">欧美靓女</button>
                <button type="button" class="btn btn-default btn-inverse active">少女</button>
                <button type="button" class="btn btn-default btn-inverse active">女阴</button>
                <button type="button" class="btn btn-default btn-inverse active">乳房</button>
                <button type="button" class="btn btn-default btn-inverse active">肉欲</button>
                <button type="button" class="btn btn-default btn-inverse active">下流</button>
                <button type="button" class="btn btn-default btn-inverse active">色情</button>
            </div>
            <div class="row">


                @foreach($pics as $mov)
                    <div class="col-md-3">
                        <div  class="thumbnail">
                            <iframe src="src="{{$mov->thumbnail}}""><a href="/play/{{$mov->id}}"><img width="250" height="170" src="{{$mov->thumbnail}}" /></a>
                            </iframe>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
