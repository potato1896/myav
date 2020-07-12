@extends('layouts.master')
@section('title')
{{$pic->title}}
@endsection
@section('link')
    <script src="http://www.jq22.com/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/magnific-popup.css')}}">
    <script src="{{ URL::asset('js/jquery.magnific-popup.min.js')}}"></script>
@endsection
@section('content')



    <div class="row clearfix" style="margin-top:100px;">
        <h4>{{$pic->title}}</h4>
        <div class="col-md-12 column">
            @foreach($imgs as $pic)
<a href="{{$bigs[$loop->index]}}"> <img src="{{$pic}}"></a>
            @endforeach
        </div>

        <script>

            (function($){
                $('.col-md-12').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,

                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function(element) {
                            return element.find('img');
                        }
                    }

                });
            })(jQuery);

        </script>
    </div>
@endsection
