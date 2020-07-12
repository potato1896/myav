<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="referrer" content="no-referrer" />
    <title> @yield('title', '首页')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/swiper.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
    <link rel="stylesheet" href="{{ URL::asset('css/head.css') }}" />
    <style type="text/css">
 h3 {color: white} h4{color: white} h2{color: white} img{img-rounded}
    </style>
    @yield('link')
</head>
<body>

<header class="header">
    <div class="container clearfix">
        <div class="fl left">
            <a href="javascript:void(0)" ><img src="image/logo.png" alt="" class="img1" /></a>
            <a href="javascript:void(0)" ><img src="image/logo2.jpg" alt="" class="img2" /></a>
        </div>
        <div class="fr nav">
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <input type="text" class="form-control" placeholder="tipe here"/>
                </div>
                <button type="submit" class="btn btn-default btn-sm">Submit</button>
            </form>

        </div>

        <div class="fr nav">
            <ul class="navbar_nav" data-in="fadeInDown" data-out="fadeOutUp">
                <li class="active">
                    <a href="/">首页</a>
                </li>
                <li class="dropdown">
                    <a href="/magnet/all">
                        磁力AV
                    </a>
                    <div class="dropdown_menu">
                        <a href="/magnet/censored">有码</a>
                        <a href="/magnet/uncensored">无码</a>
                        <a href="/magnet/west">欧美</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="/video/all">在线视频</a>
                    <div class="dropdown_menu">
                        <a href="/video/sub">中文字幕</a>
                        <a href="/video/censored">有码</a>
                        <a href="/video/uncensored">无码</a>
                        <a href="/video/selfie">自拍</a>
                        <a href="/video/west">欧美</a>
                        <a href="/video/cartoon">卡通</a>
                        <a href="/video/xrated" >三级</a>
                    </div>
                </li>
                <li>
                    <a href="/piclist/all">【图片】欧美靓女</a>
                </li>
                <li>
                    <a href="javascript:void(0)">【图片】亚洲靓女</a>
                </li>
                <li>

                </li>

            </ul>

        </div>

        <a href="javascript:void(0)" id="navToggle">
            <span></span>
        </a>
    </div>
</header>
<!--移动端的导航-->
<div class="m_nav">
    <div class="top clearfix">
        <img src="image/closed.png" alt="" class="closed" />
    </div>
    <div class="logo">
        <img src="image/logo2.jpg" alt="" />
    </div>
    <ul class="ul" data-in="fadeInDown" data-out="fadeOutUp">
        <li class="active">
            <a href="javascript:void(0)">首页</a>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)">
                磁力AV
            </a>
            <div class="dropdown_menu">
                <a href="#">有码</a>
                <a href="#">无码</a>
                <a href="#">欧美</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0)">在线视频</a>
            <div class="dropdown_menu">
                <a href="#">中文字幕</a>
                <a href="#">有码</a>
                <a href="#">无码</a>
                <a href="#">自拍</a>
                <a href="#">欧美</a>
                <a href="#">卡通</a>
                <a href="/video/xrated" >三级</a>
            </div>
        </li>
        <li>
            <a href="javascript:void(0)">【图片】欧美靓女</a>
        </li>
        <li>
            <a href="javascript:void(0)">【图片】亚洲靓女</a>
        </li>
    </ul>

    <!-- 搜索框 -->
    <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>

    </form>
</div>
<div class="container">

@yield('content')

</div>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script src="http://www.jq22.com/jquery/bootstrap-3.3.4.js"></script>
<script src="{{ URL::asset('js/swiper.min.js') }}"></script>
<script>
    $(function(){
        //超过一定高度导航添加类名
        var nav=$("header"); //得到导航对象
        var win=$(window); //得到窗口对象
        var sc=$(document);//得到document文档对象。
        win.scroll(function(){
            if(sc.scrollTop()>=100){
               //nav.addClass("on");
            }else{
               //nav.removeClass("on");
            }
        })

        //移动端展开nav
        $('#navToggle').on('click',function(){
            $('.m_nav').addClass('open');
        })
        //关闭nav
        $('.m_nav .top .closed').on('click',function(){
            $('.m_nav').removeClass('open');
        })

        //二级导航  移动端
        $(".m_nav .ul li").click(function() {
            $(this).children("div.dropdown_menu").slideToggle('slow')
            $(this).siblings('li').children('.dropdown_menu').slideUp('slow');
        });

    })
</script>
</body>
</html>
