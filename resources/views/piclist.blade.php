@extends('layouts.master')
@section('title')
    @if($column==3)
        西洋靓女
    @elseif($column==4)
        亚洲靓女
    @endif
    _{{$catalog}}
@endsection
@section('link')


@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row">
                <button type="button" class="btn btn-default btn-inverse active">{{$catalog}}</button>
                <a href="/rand/{{$column}}/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
            </div>
            <div class="row">


                @foreach($pics as $pic)
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">

                                <a title="{{$pic->title}}"  href="/pic/{{$pic->id}}"> <img  alt="{{$pic->title}}"  height="250px" src="{{$pic->thumbnail}}" /></a>

                        </div>

                    </div>
                @endforeach

            </div>
            <div class="row"> {{ $pics->links() }}</div>

        </div>


    </div>
@endsection
