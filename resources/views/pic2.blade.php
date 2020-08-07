@extends('layouts.master')
@section('title')
{{$pic->title}}
@endsection
@section('link')
   <script src="{{ URL::asset('js/viewer.min.js')}}"></script>
   <link rel="stylesheet" href="{{ URL::asset('css/viewer.min.css') }}" />

   <script src="http://www.jq22.com/jquery/1.9.1/jquery.min.js"></script>
   <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css')}}">
   <script src="{{ URL::asset('js/jquery.magnific-popup.min.js')}}"></script>
@endsection
@section('content')



    <div class="row clearfix" style="margin-top:100px;">
        <h4>{{$pic->title}} </h4>

        <div class="col-md-12 column">
            <div class="galler">
            @foreach($imgs as $pic)

                        <img width="100%"  referrerPolicy="no-referrer"  src="{{$pic}}"/>
            @endforeach
            </div>
            <script>

            </script>
        </div>
    </div>
@endsection
