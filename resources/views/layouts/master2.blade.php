<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="referrer" content="no-referrer" />
    <title> @yield('title', '首页')</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">



    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <!-- HTML5 Shiv 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
    <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        body{background-color: #1b1b1b}
        h3 {color: white} h4{color: white} h2{color: white}
        span{color: #ff0000} img{border-radius:6px}
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .waterfalls {
            padding:10px;
            position: relative;
            margin: 0 auto;
            column-gap: 20px; /* 每列的距离，不设置这个可以通过margin来设置边距 */
        }

        .box {
            break-inside: avoid; /* 这个是设置多列布局页面下的内容盒子如何中断，如果不加上这个，每列的头个元素就不会置顶，配合columns使用 */
            margin-bottom:15px;
            /* background:dodgerblue; */
            color:white;
            border-radius:5px;
        }
        .pic img {
            width: 100%; /* 建议每个图片宽高为100%，如果不设置宽高，就会溢出外层盒子的，或者设置固定宽度，最好不要宽过外层盒子或者高过外层盒子。这里说的外层盒子就是 html 代码里的 .box */
            height: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        @media (min-width: 992px) {
            .waterfalls {
                column-count: {{$num}};
            }

        }
        @media (min-width: 768px) and (max-width: 991px) {
            .waterfalls {
                column-count: {{$num-2}};
            }

        }
        @media (max-width: 767px) {
            .waterfalls {
                column-count: {{$num-4}};
            }
        }
    </style>

    @yield('link')
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-md-12 column">
            @include('layouts.nav')
        </div>
    </div>
@yield('content')

</div>

</body>
</html>
