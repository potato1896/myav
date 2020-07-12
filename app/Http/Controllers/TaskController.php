<?php

namespace App\Http\Controllers;

use App\movie;
use App\pic;
use App\StringHelper;
use App\video;
use Barryvdh\Debugbar\Facade as Debug;

class TaskController extends Controller
{
    public function index()
    {
        $movies=movie::orderBy('releasedate', 'desc')->limit(12)->get();
        $videos=video::orderBy('id', 'desc')->limit(8)->get();
        $pics=pic::where('source_web','silkengirl')->orderBy('id', 'desc')->limit(8)->get();
        $picatalog=explode(',',config('public.pic_catalog'));
        $videocatalog=explode(',',config('public.video_catalog'));
        return view('index', compact('movies','videos','pics','picatalog','videocatalog'));
    }
    public function pic($id)
    {
        $pic = pic::where('id', $id)->first();
        $imgs = explode(" ", $pic->content);
        for($i=0;$i<count($imgs);$i++)
        {
            if(StringHelper::startsWith($imgs[$i],'//'))
                $imgs[$i]='https:'.$imgs[$i];
        }
        for ($i = 0; $i < count($imgs); $i++) {
            $bigs[$i] = str_replace('tn_', '', $imgs[$i]);
            if(StringHelper::startsWith($bigs[$i],'//'))
                $bigs[$i]='https:'.$bigs[$i];
        }
        return view('pic', compact('imgs', 'bigs','pic'));
    }
    public function piclist($type)
    {
        $arr=explode(' ',config('public.pic_host')) ;
        if($type=='all')
        {
            $pics=pic::whereIn('source_web',$arr)->orderBy('id','desc')->paginate(32);

        }
        else
        {
            $pics=pic::where('catalog',$type)->whereIn('source_web',$arr)->orderBy('id','desc')->paginate(32);

        }

        $catalog=$type;$column=3;$num=3;
        Debug::info(config('public.pic_host'));
        return view('piclist',compact('pics','column','catalog','num'));
    }
    public function player($id)
    {
        $movies=video::where("id",$id)->first();
        return view('player', compact('movies'));
    }
    public function iplayer($id)
    {
        $movies=video::where("id",$id)->first();
        return view('iplayer', compact('movies'));
    }
    public function play($type,$id)
    {
        if($type=='play')
        {
            $column='在线视频';
            $movies=video::where("id",$id)->first();
            if(strpos ( $movies->source_url , 'df' ) !== false || strpos ( $movies->source_url , 'xp1' )!==false  )
            {
                $sign='one';
            }
            else
                $sign='two';
            $movies->thumbnail=str_replace('/s/','/b/',$movies->thumbnail);
            return view('play', compact('movies','sign','column'));
        }
        if($type='show')
        {
            $column='磁力AV';
            $movies=movie::where("id",$id)->first();
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
                    $randarr[$i]=mt_rand(1,100000);
                }
                $movies2=movie::whereIn("id",$randarr)->get();

            $num=3;
            return view('show', compact('movies','movies2','num','column','bigallery','smallgallery','magnets'));
        }


    }
    public function magnet($name)
    {
        if($name=='all')
        {
            $catalog='全部';
            $num=2;
            $movies=movie::orderBy('releasedate', 'desc')->paginate(16);
        }
        if($name=='censored')
        {
            $catalog='有码';
            $num=2;
            $movies=movie::where('column', 1)->orderBy('releasedate', 'desc')->paginate(16);
        }
        if($name=='uncensored')
        {
            $catalog='无码';
            $num=3;
            $movies=movie::where('column', 2)->orderBy('releasedate', 'desc')->paginate(16);
        }
        if($name=='west')
        {
            $catalog='欧美';
            $num=3;
            $movies=movie::where('column', 3)->orderBy('releasedate', 'desc')->paginate(16);
        }
        $column=1;
        return \view('list',compact('movies','num','catalog','column','name'));
    }
    public function magnetwhere($name,$type)
    {
        $num=2;
        if($name=='all')
        {
            $catalog='全部';

            $movies=movie::orderBy('releasedate', 'desc')->paginate(16);
        }else
        {
            if($name=='censored')
            {$column=1;$catalog='有码';}
            elseif($name=='uncensored')
            {$column=2;$catalog='无码';}
            else
            {$column=3;$catalog='欧美';}

            $movies=movie::where('column', $column)->where($type,1)->orderBy('releasedate', 'desc')->paginate(30);

        }


        return \view('list',compact('movies','num','catalog','name'));
    }
    public function rand($id,$catalog)
    {

        if($id==1)
        {
            $column = 1;
            $num = 3;

            if ($catalog == '有码') {

                for ($i = 0; $i < 12; $i++) {
                    $arr[$i] = mt_rand(1, config('public.video_sub'));
                }
                $num = 2;
                $movies = movie::where('column', 1)->whereIn("id", $arr)->get();
            }
            if ($catalog == '无码') {
                $column = 1;
                for ($i = 0; $i < 12; $i++) {
                    $arr[$i] = mt_rand(1, config('public.video_sub'));
                }

                $movies = movie::where('column', 2)->whereIn("id", $arr)->get();
            }
            if ($catalog == '欧美') {
                $column = 1;
                for ($i = 0; $i < 12; $i++) {
                    $arr[$i] = mt_rand(1, config('public.video_sub'));
                }

                $movies = movie::where('column', 3)->whereIn("id", $arr)->get();
            }

        }
        elseif ($id==2)
        {
            $column=2;$num=3;
            if($catalog=="中文字幕")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_sub'));
                }
                $catalog='中文字幕';
                $movies=video::where('catalog','中文')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="有码")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_censored'));
                }
                $catalog='有码';
                $movies=video::where('catalog','有码')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="无码")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
                $catalog='无码';
                $movies=video::where('catalog','无码')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="欧美")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_west'));
                }
                $catalog='欧美';
                $movies=video::where('catalog','欧美')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="三级")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
                $catalog='三级';
                $movies=video::where('catalog','三级')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="卡通")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
                $catalog='卡通';
                $movies=video::where('catalog','卡通')->whereIn("column_id",$arr)->get();
            }
            if($catalog=="自拍")
            {
                for ($i=0;$i<12;$i++)
                {
                    $arr[$i]=mt_rand(1,config('public.video_uncensored'));
                }
                $catalog='自拍';
                $movies=video::where('catalog','短片')->whereIn("column_id",$arr)->get();
            }
        }
        return view('rand',compact('movies','column','catalog','num'));
    }
    public function videolist($name)
    {
        $num=3;
        if($name=='全部')
        {

            $movies=video::orderBy('id', 'desc')->paginate(16);
            $catalog="全部";
        }else
        {
            $movies=video::where('catalog', $name)->orderBy('id', 'desc')->paginate(16);
            $catalog=$name;
        }
        return view('videolist',compact('movies','num','catalog'));
    }
}
