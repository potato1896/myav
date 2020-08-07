<?php

namespace App\Http\Controllers;

use App\actor;
use App\cartoon;
use App\movie;
use App\novel;
use App\pic;
use App\StringHelper;
use App\video;
use Barryvdh\Debugbar\Facade as Debug;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class TaskController extends Controller
{
    public function index()
    {
        $movies=movie::orderBy('releasedate', 'desc')->limit(12)->get();
        $videos=video::orderBy('id', 'desc')->limit(8)->get();
        $randnum=mt_rand(1,config('public.pic_嫩女'));
        for ($i=0;$i<10;$i++)
        {
            $randarr[$i]=mt_rand(1,$randnum);
        }
        $pics=pic::where('ipstatus','Success')->where('catalog','嫩女')->where('isopen',1)->whereIn('column_id', $randarr)->get();
        $picatalog=explode(',',config('public.pic_catalog'));
        $videocatalog=explode(',',config('public.video_catalog'));
        for($i=0;$i<count($pics);$i++)
        {
            if($pics[$i]->source_web=='myteentgp')
            {}
            elseif ($pics[$i]->source_web=='sexroom')
            {

            }
            else
                $pics[$i]->thumbnail='https://'.substr( $pics[$i]->thumbnail,strpos($pics[$i]->thumbnail,'content'));
        }
        return view('index', compact('movies','videos','pics','picatalog','videocatalog'));
    }
    public function star($id,Request $request)
    {
        $actor=actor::where('id',$id)->first();
        $result=$actor->movies->toArray();
        $page=1;
        if ($request->has('page')) {
            $page = $request->input('page');
            $page = $page <= 0 ? 1 : $page ;//当前要访问的页数
        }
        $perpage=28;//每页数量


        //对查询结果做切分：

        $total=count($result);//结果集总数
        $result=array_slice($result,($page-1)*$perpage,$perpage,true);
        //调用手动分页类：
        $paginator = new LengthAwarePaginator($result, $total, $perpage, $page, [
            'path' => $request->url(), 'query' => $request->query()
        ]);

        $result= $paginator->toArray()['data'];

        //返回处理后结果集和分页给页面：
        $num=6;

        return view('star',compact('actor','result','num','paginator'));
    }
    public function pic($id)
    {
        $pic = pic::where('id', $id)->first();
        $imgs = explode(" ", $pic->content);
        if($pic->source_web=='myteentgp')
        {
            $pre_url=config('public.url2');
            $bigs=explode(' ',$pic->bigallery);
            for($i=0;$i<count($bigs);$i++)
            {
                $temp = substr($bigs[$i],0, strrpos($bigs[$i],'_'));
                $bigs[$i]=$pre_url.$bigs[$i];
                $imgs[$i]=$pre_url.$temp."_t.jpg";
            }
        }elseif ($pic->source_web=='sexroom')
        {
            if(StringHelper::startsWith($imgs[0],'https')===false)
            {
                for ($i=0;$i<count($imgs);$i++)
                {
                    $temp=$imgs[$i];
                    $imgs[$i]='https://cdn.sexroom.xxx/contents/albums/main/200x150/'.$imgs[$i];
                    $bigs[$i]='https://cdn.sexroom.xxx/contents/albums/sources/'.$temp;
                }
            }else
            {
                for ($i=0;$i<count($imgs);$i++)
                {
                    $bigs[$i]=str_replace('https://cdn.sexroom.xxx/contents/albums/main/200x150/','https://cdn.sexroom.xxx/contents/albums/sources/',$imgs[$i]);
                }
            }
        }
        else
        {
            $parts=   parse_url($pic->source_url);
            $pre_url=$parts['scheme'].'://'.$parts['host'];
            for ($i = 0; $i < count($imgs); $i++) {
                $bigs[$i] = str_replace('tn_', '', $imgs[$i]);
                if(StringHelper::startsWith($bigs[$i],'//'))
                {
                    $imgs[$i]='https:'.$imgs[$i];
                    $bigs[$i]='https:'.$bigs[$i];
                }elseif (StringHelper::startsWith($bigs[$i],'/'))
                {
                   $imgs[$i]=$pre_url.$imgs[$i];
                    $bigs[$i]=$pre_url.$bigs[$i];
                }
            }
        }
        return view('pic', compact('imgs', 'bigs','pic'));
    }
    public function pic2($id)
    {
        $pic = pic::where('id', $id)->first();
        $imgs = explode(" ", $pic->content);
        for($i=0;$i<count($imgs);$i++)
        {
            if(StringHelper::startsWith($imgs[$i],'attachments'))
                $imgs[$i]='http://38.103.161.235/forum/'.$imgs[$i];
        }
        return view('pic2', compact('imgs','pic'));
    }
    public function piclist($type)
    {
        $pics=pic::where('catalog',$type)->where('ipstatus','Success')->where('isopen',1)->orderBy('id','desc')->paginate(35);
        for($i=0;$i<count($pics);$i++)
        {
            if($pics[$i]->source_web=='sexroom')
                continue;
            $pics[$i]->thumbnail='https://'.substr( $pics[$i]->thumbnail,strpos($pics[$i]->thumbnail,'content'));
        }
        $catalog=$type;$num=5;$column=3;
        $catalogs=explode(',',config('public.pic_catalog'));
        return view('piclist',compact('pics','catalogs','column','catalog','num'));
    }
    public function piclist2($type)
    {
        $pics=pic::where('catalog',$type)->orderBy('release_date','desc')->paginate(35);
        for($i=0;$i<count($pics);$i++)
        {
            $temp=explode(' ',$pics[$i]->content);
            $pics[$i]->thumbnail=$temp[0];

            if(StringHelper::startsWith($pics[$i]->thumbnail,'attachments'))
                $pics[$i]->thumbnail='http://38.103.161.235/forum/'.$temp[0];
            Debug::info($pics[$i]->thumbnail);
        }
        $catalog=$type;$num=5;$column=3;
        $catalogs=explode(',',config('public.pic2_catalog'));
        return view('piclist2',compact('pics','catalogs','column','catalog','num'));
    }
    public function cartoonlist()
    {
        $pics=cartoon::where('catalog','卡通漫画')->orderBy('release_date','desc')->paginate(35);
        for($i=0;$i<count($pics);$i++)
        {
            $temp=explode(' ',$pics[$i]->content);
            for($j=0;$j<count($temp);$j++) {
                $str=substr($temp[$j],strlen($temp[$j])-3);
                if(substr_count($pics[$i],$str)==1)
                    continue;
                $pics[$i]->thumbnail = $temp[$j];
                break;
            }
            if(StringHelper::startsWith($pics[$i]->thumbnail,'attachments'))
                $pics[$i]->thumbnail='http://38.103.161.235/forum/'.$pics[$i]->thumbnail;
            Debug::info($pics[$i]->thumbnail);
        }
        $catalog='卡通漫画';$num=5;$column=3;
        $catalogs=explode(',',config('public.cartoon_catalog'));
        return view('cartoonlist',compact('pics','catalogs','column','catalog','num'));
    }
    public function cartoon($id)
    {
        $pic = cartoon::where('id', $id)->first();
        $imgs = explode(" ", $pic->content);
        for($i=0;$i<count($imgs);$i++)
        {
            if(StringHelper::startsWith($imgs[$i],'attachments'))
                $imgs[$i]='http://38.103.161.235/forum/'.$imgs[$i];
        }
        return view('cartoon', compact('imgs','pic'));
    }
    public function player($id)
    {
        $movies=video::where("id",$id)->first();
        $movies->content=str_replace('[url1]',config('public.url1'),$movies->content);

        return view('player', compact('movies'));
    }
    public function iplayer($id)
    {
        $movies=video::where("id",$id)->first();
            $movies->content=str_replace('[url1]',config('public.url1'),$movies->content);

        return view('iplayer', compact('movies'));
    }
    public function play($type,$id)
    {
        if($type=='play') {
            $column = '在线视频';
            $movies = video::where("id", $id)->first();
            if (strpos($movies->source_url, 'df') !== false || strpos($movies->source_url, 'xp1') !== false) {
                $sign = 'one';
            } else
                $sign = 'two';
            $movies->thumbnail=str_replace('/s/','/b/',$movies->thumbnail);

            return view('play', compact('movies','sign','column'));
        }
        if($type='show')
        {
            $column='磁力AV';
            $movies=movie::where("id",$id)->first();
            if($movies->column==1)
            {$column=1;$randnum=config('public.magnet_censored');}
            elseif ($movies->column==2)
            {$column=2;$randnum=config('public.magnet_uncensored');}
            else
            {$column=3;$randnum=config('public.magnet_west');}
            $magnets=$movies->magnets;

            if(isset($movies->gallerybig))
            {
                $arr=explode('|',$movies->gallerybig);

                $num=(int)$arr[1];
                if(strstr($arr[0],'-1.jpg'))
                {
                    $pre=substr($arr[0],0,strrpos($arr[0],'-'));
                    for ($i=1;$i<=$num;$i++)
                    {
                        $bigallery[$i-1]=$pre.'-'.$i.'.jpg';
                    }
                }
                if(strstr($arr[0],'_1.jpg'))
                {

                    $pre=substr($arr[0],0,strrpos($arr[0],'_'));
                    for ($i=1;$i<=$num;$i++)
                    {
                        $bigallery[$i-1]=$pre.'_'.$i.'.jpg';
                    }
                }


            }
            if(isset($movies->gallerythumb))
            {
                $ar=explode('|',$movies->gallerythumb);

                $nu=(int)$ar[1];
                if( strstr($ar[0],'_1.jpg'))
                {
                    $pre=substr($ar[0],0,strrpos($ar[0],'_'));
                    for ($j=1;$j<=$nu;$j++)
                    {
                        $smallgallery[$j-1]=$pre.'_'.$j.'.jpg';
                    }
                }
                if( strstr($ar[0],'-1.jpg'))
                {
                    $pre=substr($ar[0],0,strrpos($ar[0],'-'));
                    for ($j=1;$j<=$nu;$j++)
                    {
                        $smallgallery[$j-1]=$pre.'-'.$j.'.jpg';
                    }
                }
            }

                for ($i=0;$i<8;$i++)
                {
                    $randarr[$i]=mt_rand(1,$randnum);
                }
                $movies2=movie::where('column',$column)->whereIn("column_id",$randarr)->get();

            $num=3;

            $stars=$movies->actors;

            $tags=explode(' ',$movies->catalog);
            $movies->designation=str_replace('https:www.javbus.one','',$movies->designation);
            return view('show', compact('movies','movies2','stars','num','column','bigallery','smallgallery','magnets','tags'));
        }


    }
    public function search(Request $request)
    {
        $select = $request->input('select');
        $search=$request->input('search');
        $num=6;
        if($select==1)
        {
            $url='show';$type='磁力AV';
        }
        elseif ($select==2)
        {$url='play';$type="在线视频";}
        elseif ($select==3)
        {$url='pic';$type='欧美靓女';}
Debug::info($type);
        $page=1;
        if ($request->has('page')) {
            $page = $request->input('page');
            $page = $page <= 0 ? 1 : $page ;//当前要访问的页数
        }
        $perpage=30;//每页数量

        if($select==1) {
            $num=6;
            $result = DB::select('SELECT * FROM movies WHERE MATCH (title) AGAINST (\'' . $search . '\' IN NATURAL LANGUAGE MODE)');

        }elseif($select==3)
        {
            $num=5;
            $result = DB::select('SELECT * FROM pics WHERE MATCH (catalog) AGAINST (\'' . $search . '\' IN NATURAL LANGUAGE MODE)');

        }
        elseif ($select==2)
        {
            $num=5;
            $result = DB::select('SELECT * FROM videos WHERE MATCH (catalog,title) AGAINST (\'' . $search . '\' IN NATURAL LANGUAGE MODE)');
        }


        //对查询结果做切分：

        $total=count($result);//结果集总数
        $result=array_slice($result,($page-1)*$perpage,$perpage,true);
        //调用手动分页类：
        $paginator = new LengthAwarePaginator($result, $total, $perpage, $page, [
        'path' => $request->url(), 'query' => $request->query()
]);

        $result= $paginator->toArray()['data'];

        //返回处理后结果集和分页给页面：

        return view('search',compact('result','paginator','url','type','num','search','total'));

    }
    public function tag($type,$tag,Request $request)
    {


            $result = DB::select('SELECT * FROM movies WHERE  MATCH (catalog) AGAINST (\'' . $tag . '\' IN NATURAL LANGUAGE MODE)');



        $page=1;

        if ($request->has('page')) {
            $page = $request->input('page');
            $page = $page <= 0 ? 1 : $page ;//当前要访问的页数
        }
        $perpage=24;//每页数量


        $total=count($result);//结果集总数
        $result=array_slice($result,($page-1)*$perpage,$perpage,true);
//调用手动分页类：

        $paginator = new LengthAwarePaginator($result, $total, $perpage, $page, [
            'path' => $request->url(), 'query' => $request->query()
        ]);

        $result= $paginator->toArray()['data'];
        if($type=='磁力AV')
        {
            $url='show';
        }

//返回处理后结果集和分页给页面：
        $num=3;
        return view('tag',compact('result','paginator','num','total','type','tag','url'));
    }
    public function magnetlist($name)
    {
        if($name=='全部')
        {
            $catalog='全部';
            $num=6;
            $movies=movie::orderBy('releasedate', 'desc')->paginate(config('public.page_num'));
        }
        if($name=='有码')
        {
            $catalog='有码';
            $num=6;
            $movies=movie::where('column', 1)->orderBy('releasedate', 'desc')->paginate(config('public.page_num'));
        }
        if($name=='无码')
        {
            $catalog='无码';
            $num=6;
            $movies=movie::where('column', 2)->orderBy('releasedate', 'desc')->paginate(config('public.page_num'));
        }
        if($name=='欧美')
        {
            $catalog='欧美';
            $num=6;
            $movies=movie::where('column', 3)->orderBy('releasedate', 'desc')->paginate(config('public.page_num'));
        }
        if($name=="3D")
        {
            $catalog='3D';
            $num=7;
            $movies=movie::where('catalog2','vr')->orderBy('releasedate', 'desc')->paginate(config('public.page_num'));

        }
        $column=1;
        $catalogs=explode(',',config('public.magnet_catalog'));
        return \view('magnetlist',compact('movies','num','catalog','catalogs','column','name'));
    }
    public function magnetlistwhere($name,$type)
    {
        $num=6;
        if($name=='all')
        {
            $catalog='全部';

            $movies=movie::orderBy('releasedate', 'desc')->paginate(36);
        }else
        {
            if($name=='有码')
            {$column=1;$catalog='有码';}
            elseif($name=='无码')
            {$column=2;$catalog='无码';}
            elseif($name=='欧美')
            {$column=3;$catalog='欧美';}
elseif ($name=='3D')
{$column=3;$catalog='3D';}
            $movies=movie::where('column', $column)->where($type,1)->orderBy('releasedate', 'desc')->paginate(30);

        }

        $catalogs=explode(',',config('public.magnet_catalog'));
        return \view('magnetlist',compact('movies','num','catalog','catalogs','name'));
    }
    public function rand($id,$catalog)
    {

        if($id==1)
        {
            $column = 1;
            $num=5;

            if ($catalog == '有码') {

                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_censored'));
                }
                $num = 6;
                $movies = movie::where('column', 1)->whereIn("column_id", $arr)->get();
            }
            if ($catalog == '全部') {

                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_censored'));
                }

                $movies = movie::whereIn("id", $arr)->get();
            }
            if ($catalog == '无码') {
                $column = 1;
                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_uncensored'));
                }

                $movies = movie::where('column', 2)->whereIn("column_id", $arr)->get();
                $num = 6;
            }
            if ($catalog == '欧美') {
                $column = 1;
                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_west'));
                }

                $movies = movie::where('column', 3)->whereIn("column_id", $arr)->get();
            }

        }
        elseif ($id==2)
        {
            $column=2;$num=3;
            $catalogs=explode(',',config('public.video_catalog'));
            if($catalog=="中文字幕")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_sub'));
                }
            }
            if($catalog=="有码")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_censored'));
                }
            }
            if($catalog=="无码")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            if($catalog=="欧美")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_west'));
                }
            }
            if($catalog=="三级")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            if($catalog=="卡通")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            if($catalog=="自拍")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }

            }
            $movies=video::where('catalog',$catalog)->whereIn("column_id",$arr)->get();

        }
        elseif ($id==3)
        {
            for ($i=0;$i<config('public.page_num');$i++)
            {
                $arr[$i]=mt_rand(1,config('public.video_uncensored'));
            }
            $movies=pic::where('catalog',$catalog)->where('ipstatus','Success')->where('isopen',1)->whereIn("column_id",$arr)->get();
            $column=3;$num=5;
            for($i=0;$i<count($movies) ;$i++)
            {
                $movies[$i]->thumbnail=str_replace('www.rabbitsfun.com/','',$movies[$i]->thumbnail);
            }
            $catalogs=explode(',',config('public.pic_catalog'));
        }
        return view('rand',compact('movies','column','catalog','catalogs','num'));
    }
    public function ajaxrand($id,$catalog)
    {

        if($id==1)
        {
            $column = 1;
            $num = 3;

            if ($catalog == '有码') {

                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_censored'));
                }
                $num = 2;
                $movies = movie::where('column', 1)->whereIn("column_id", $arr)->get();
            }
            if ($catalog == '全部') {

                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_censored'));
                }
                $num = 2;
                $movies = movie::whereIn("id", $arr)->get();
            }
            if ($catalog == '无码') {
                $column = 1;
                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_uncensored'));
                }

                $movies = movie::where('column', 2)->whereIn("column_id", $arr)->get();
            }
            if ($catalog == '欧美') {
                $column = 1;
                for ($i = 0; $i < config('public.page_num'); $i++) {
                    $arr[$i] = mt_rand(1, config('public.magnet_west'));
                }

                $movies = movie::where('column', 3)->whereIn("column_id", $arr)->get();
            }

        }
        elseif ($id==2)
        {
            $column=2;$num=3;
            $catalogs=explode(',',config('public.video_catalog'));
            if($catalog=="中文字幕")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_sub'));
                }
            }
            if($catalog=="有码")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_censored'));
                }
            }
            if($catalog=="无码")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            if($catalog=="欧美")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_west'));
                }
            }
            if($catalog=="三级")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            if($catalog=="卡通")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                } }
            if($catalog=="自拍")
            {
                for ($i=0;$i<config('public.page_num');$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
            }
            $movies=video::where('catalog',$catalog)->whereIn("column_id",$arr)->get();

        }elseif ($id==3)
        {
            for ($i=0;$i<config('public.page_num');$i++)
            {
                $arr[$i]=mt_rand(1,config('public.video_uncensored'));
            }
            $movies=pic::where('catalog',$catalog)->where('ipstatus','Success')->whereIn("column_id",$arr)->get();
            $column=3;$num=2;
            $catalogs=explode(',',config('public.pic_catalog'));
        }
        //return view('rand',compact('movies','column','catalog','catalogs','num'));
        return $movies;
    }
    public function videolist($name)
    {
        $num=3;
        if($name=='全部')
        {

            $movies=video::orderBy('id', 'desc')->paginate(config('public.page_num'));
            $catalog="全部";
        }else
        {
            $movies=video::where('catalog', $name)->orderBy('id', 'desc')->paginate(config('public.page_num'));
            $catalog=$name;
        }
        $catalogs=explode(',',config('public.video_catalog'));

        return view('videolist',compact('movies','num','catalog','catalogs'));
    }
    public function novelist($catalog)
    {
        $num=6;
        $movies=novel::where('catalog', $catalog)->orderBy('releasedate', 'desc')->paginate(config('public.page_num'));
        Debug::info(date("Y-m-d"));
        foreach ($movies as $mov)
        {
            if($mov->releasedate==date("Y-m-d"))
                $mov->releasedate='<span>'.$mov->releasedate.'</span>';
        }
        $catalogs=explode(',',config('public.novel_catalog'));
        return view('novelist',compact('movies','catalog','catalogs','num'));
    }
    public function novel($id)
    {
        $num=6;
        $movies=novel::where('id', $id)->first();
        $movies->content=str_replace(PHP_EOL,'<br>',$movies->content);

        return view('novel',compact('movies','num'));
    }

}
