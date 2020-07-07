@extends('layouts.master')
@section('title', '列表')
@section('link')
    <link rel="stylesheet" href="{{ URL::asset('css/simplelightbox.min.css') }}">

    <script src="{{ URL::asset('js/simple-lightbox.min.js') }}"></script>

@endsection
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
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">
                            <a href="/content/play/{{$mov->id}}"> <img height="250px" src="{{$mov->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach

            </div>
            <div class="row"> {{ $movies->links() }}</div>

        </div>


    </div>
@endsection
