<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div  class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="/">首页</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="/magnet/all" class="dropdown-toggle" data-toggle="dropdown">磁力AV<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    @foreach(explode(',',config('public.magnet_catalog')) as $catalog)
                        <li>
                            <a href="/magnetlist/{{$catalog}}">{{$catalog}}</a>
                        </li>
                    @endforeach


                </ul>
            </li>
            <li class="dropdown">
                <a href="/videolist/全部" class="dropdown-toggle" data-toggle="dropdown">在线视频<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    @foreach(explode(',',config('public.video_catalog')) as $catalog)
                        <li>
                            <a href="/videolist/{{$catalog}}">{{$catalog}}</a>
                        </li>
                    @endforeach


                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">欧美靓女<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    @foreach(explode(',',config('public.pic_catalog')) as $catalog)
                        <li>
                            <a href="/piclist/{{$catalog}}">{{$catalog}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">综合美图<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    @foreach(explode(',',config('public.pic2_catalog')) as $catalog)
                        <li>
                            <a href="/piclist2/{{$catalog}}">{{$catalog}}</a>
                        </li>
                    @endforeach

                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">成人小说<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    @foreach(explode(',',config('public.novel_catalog')) as $catalog)
                        <li>
                            <a href="/novelist/{{$catalog}}">{{$catalog}}</a>
                        </li>
                    @endforeach
                   

                </ul>
            </li>

            <li>
                <a href="/cartoon">卡通漫画</a>
            </li>

        </ul>
        <form class="navbar-form navbar-left" role="search" action="/search" method="get">
            <div class="form-group">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <select name="select" class="form-control">
                    <option value="1">磁力AV</option>
                    <option value="2">在线视频</option>
                    <option value="3">欧美靓女</option>

                </select>
                <input name="search" type="text" class="form-control" />
            </div> <button type="submit" class="btn btn-default">提交</button>
        </form>

    </div>

</nav>
