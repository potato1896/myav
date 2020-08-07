@extends('layouts.master')
@section('title')
    {{$column}}_{{$movies->title}}
@endsection
@section('link')
    <link rel="stylesheet" href="{{ URL::asset('css/simplelightbox.min.css') }}">

    <script src="{{ URL::asset('js/simple-lightbox.min.js') }}"></script>

@endsection
@section('content')



    <div class="row clearfix">
        <div class="col-md-8 column" style="margin-top:100px;">
         <a href="/dplayer/{{$movies->id}}"><img class="img-rounded" width="100%" src="{{$movies->thumbnail}}"></a>

        </div>

        <div class="col-md-4 column" style="margin-top:100px;">

            <h3>{{$movies->title}}</h3>
            @if($sign=='one')
                <a class = "col-md-offset-4 col-lg-offset-4col-xl-offset-4" href="/player/{{$movies->id}}"><button type="button" class="btn btn-default btn-inverse active">播放</button></a>
            @else
                <a class = "col-md-offset-4 col-lg-offset-4col-xl-offset-4" href="/iplayer/{{$movies->id}}"><button type="button" class="btn btn-default btn-inverse active">播放</button></a>
                <h4 style="color: white">有弹窗广告，非本站广告</h4>
            @endif


        </div>
    </div>
@endsection
