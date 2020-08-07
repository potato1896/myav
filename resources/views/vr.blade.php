@extends('layouts.master2')
@section('title')
    磁力AV_虚拟视频
@endsection
@section('link')

@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top:100px;">
            <div class="row"> {{ $movies->links() }}</div>
            <div class="row">
                <div class="waterfalls">
                    @foreach($movies as $mov)
                        <div class="box">

                            <div class="pic">

                                <a title="{{$mov->title}}"  href="/content/show/{{$mov->id}}"> <img  alt="{{$mov->title}}"  height="250px" src="{{$mov->thumbnail}}" /></a>
                                <p>
                                    @if($mov->hashd==1)
                                        <button class="btn btn-xs btn-primary" disabled="disabled" title="包含字幕的磁力連結">高清</button>

                                    @endif

                                    @if($mov->hassub==1)
                                        <button class="btn btn-xs btn-warning" disabled="disabled" title="包含字幕的磁力連結">字幕</button>
                                    @endif

                                        @if($mov->catalog2=='vr')
                                            <button class="btn btn-xs btn-warning" disabled="disabled" title="">3D视频</button>
                                        @endif
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>



            </div>


        </div>


    </div>
@endsection
