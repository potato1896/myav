<?php

namespace App\Http\Controllers;

use App\movie;
use App\pic;
use App\video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index()
    {
        $movies=movie::orderBy('releasedate', 'desc')->limit(12)->get();
        $videos=video::orderBy('id', 'desc')->limit(8)->get();
        $pics=pic::orderBy('id', 'desc')->limit(8)->get();
        //DebugBar::info($data);
        return view('index', compact('movies','videos','pics'));
    }
    public function dplayer($id)
    {
        $movies=video::where("id",$id)->first();
        return view('dplayer', compact('movies'));
    }
    public function play($type,$id)
    {
        if($type=='play')
        {
            $movies=video::where("id",$id)->first();
        }


        return view('play', compact('movies'));
    }
    public function magnet($name)
    {
        if($name=='censored')
        {
            $num=2;
            $movies=movie::where('column', 1)->orderBy('releasedate', 'desc')->paginate(16);
        }
        if($name=='uncensored')
        {
            $num=3;
            $movies=movie::where('column', 2)->orderBy('releasedate', 'desc')->paginate(16);
        }
        if($name=='west')
        {
            $num=3;
            $movies=movie::where('column', 3)->orderBy('releasedate', 'desc')->paginate(16);
        }
        return \view('list',compact('movies','num'));
    }
    public function video($name)
    {
        if($name=='censored')
        {
            $num=2;
            $movies=video::where('catalog', '有码')->orderBy('id', 'desc')->paginate(16);
        }
        if($name=='uncensored')
        {
            $num=3;
            $movies=video::where('catalog', '无码')->orderBy('id', 'desc')->paginate(16);
        }
        if($name=='west')
        {
            $num=3;
            $movies=video::where('catalog', '欧美')->orderBy('id', 'desc')->paginate(16);
        }
        if($name=='selfie')
        {
            $num=3;
            $movies=video::where('catalog', '短片')->orderBy('id', 'desc')->paginate(16);
        }
        if($name=='cartoon')
        {
            $num=3;
            $movies=video::where('catalog', '卡通')->orderBy('id', 'desc')->paginate(16);
        }
        if($name=='sub')
        {
            $num=3;
            $movies=video::where('catalog', '中文')->orderBy('id', 'desc')->paginate(16);
        }

        return \view('list',compact('movies','num'));
    }
}
