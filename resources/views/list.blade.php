@extends('layouts.master')
@section('title')
        磁力AV_{{$catalog}}
@endsection
@section('link')


@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row">
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
                <a href="/rand/1/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
                <a href="/magnet/{{$name}}/hasmag"><button type="button" class="btn btn-default btn-inverse active">有磁力</button></a>
                <a href="/magnet/{{$name}}/hashd"><button type="button" class="btn btn-default btn-inverse active">高清</button></a>
                <a href="/magnet/{{$name}}/hassub"><button type="button" class="btn btn-default btn-inverse active">字幕</button></a>
                <a href="/magnet/{{$name}}/hasone"><button type="button" class="btn btn-default btn-inverse active">单体</button></a>



            </div>
            <div class="row">


                @foreach($movies as $mov)
                    <div class="col-md-{{$num}}" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="thumbnail">
                           <a title="{{$mov->title}}" href="/content/show/{{$mov->id}}"> <img alt="{{$mov->title}}" height="250px" src="{{$mov->thumbnail}}" /></a>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row"> {{ $movies->links() }}</div>

        </div>


    </div>
@endsection
