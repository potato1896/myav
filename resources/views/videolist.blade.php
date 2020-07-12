@extends('layouts.master')
@section('title')

        在线视频

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
                <button type="button" class="btn btn-default btn-inverse active">{{$catalog}}</button>

                <a href="/rand/2/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
               </div>
            <div class="row">


                @foreach($movies as $mov)
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">

                            <a title="{{$mov->title}}"  href="/content/play/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach

            </div>
            <div class="row"> {{ $movies->links() }}</div>

        </div>


    </div>
@endsection
