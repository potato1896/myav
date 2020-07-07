@extends('layouts.master')
@section('title', '列表')
@section('link')
    <link rel="stylesheet" href="{{ URL::asset('css/simplelightbox.min.css') }}">

    <script src="{{ URL::asset('js/simple-lightbox.min.js') }}"></script>

@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">

            <a href="/dplayer/{{$movies->id}}"> <div class="row">
<h3>{{$movies->title}}</h3><button type="button" class="btn btn-default btn-inverse active">播放</button>
                    <p>
                        <img src="{{$movies->thumbnail}}">
                    </p>



            </div> </a>


        </div>


    </div>
@endsection
