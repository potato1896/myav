@extends('layouts.master2')
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
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle"
                            data-toggle="dropdown">
                        {{$catalog}} <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        @for($i=0;$i<count($catalogs) ;$i++)
                            @if($catalogs[$i]!=$catalog)
                                <li><a href="/piclist/{{$catalogs[$i]}}">{{$catalogs[$i]}}</a></li>
                            @endif
                        @endfor
                    </ul>
                </div>
                <a href="/rand/{{$column}}/{{$catalog}}"><button type="button" class="btn btn-default btn-inverse active">随机显示</button></a>
            </div>
            <div class="row">
                <div class="waterfalls">
                    @foreach($pics as $pic)
                        <div class="box">
                            <div class="pic">
                                <a title="{{$pic->title}}"  href="/pic/{{$pic->id}}"> <img  alt="{{$pic->title}}"  src="{{$pic->thumbnail}}" /></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row"> {{ $pics->links() }}</div>

        </div>


    </div>
@endsection
