
<meta name="googlebot" content="noindex" ><meta name="robots" content="noindex" ><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel='stylesheet' href='https://www.playercloudsfluid.com/fluidplayer.min.css' type='text/css'>
<script src='https://www.playercloudsfluid.com/fluidplayer.min.js'></script>

<video id='hls-video' controls style='width: 100%; height: 100%;'>
    <source src='{{$movies->content}}' type='application/x-mpegURL'/>
</video><script>
    var myFP = fluidPlayer(
        "hls-video",{
            layoutControls:
                {
                    fillToContainer: false,primaryColor: false,posterImage: false,autoPlay: false,playButtonShowing: true,playPauseAnimation: true,mute: false,
                    logo: {imageUrl: null,position: "top left",clickUrl: null,opacity: 1,mouseOverImageUrl: null,imageMargin: "2px",hideWithControls: false,showOverAds: false},
                    htmlOnPauseBlock: {html: null,height: null,width: null},
                    allowDownload: false,
                    allowTheatre: true,
                    playbackRateEnabled: true,
                    controlBar: {autoHide: true,autoHideTimeout: 3,animated: true},
                },
            vastOptions: {"adList" : []}
        }
    );
</script><style type="text/css"> .fluid_video_wrapper .vast_video_loading{height: 0%;}.fluid_video_wrapper .vast_video_loading::before{background-color: rgba(0, 0, 0, 0);background-position: 0% 0%;background-size:70px 70px; }</style>
