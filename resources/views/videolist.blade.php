@extends('layouts.master2')
@section('title')

        在线视频

    _{{$catalog}}
@endsection
@section('link')


@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row">
                <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle"
                        data-toggle="dropdown">
                    {{$catalog}} <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" role="menu">
                    @for($i=0;$i<count($catalogs) ;$i++)
                        @if($catalogs[$i]!=$catalog)
                            <li><a href="/videolist/{{$catalogs[$i]}}">{{$catalogs[$i]}}</a></li>
                        @endif
                    @endfor
                </ul>
                </div>

                <a href="/rand/2/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
               </div>
            <div class="row">
                <div class="waterfalls">
                @foreach($movies as $mov)
                        <div class="box">

                            <div class="pic">

                            <a title="{{$mov->title}}"  href="/content/play/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>
                            <p>

                            </p>
                            </div>

                    </div>
                @endforeach
</div>
            </div>
            <div class="row"> {{ $movies->links() }}</div>

        </div>


    </div>

@endsection
