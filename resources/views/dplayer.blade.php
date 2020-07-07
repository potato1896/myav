<div id="dplayer"></div>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="{{URL::asset('js/DPlayer.min.js')}}"></script>
<script>
    const dp = new DPlayer({
        container: document.getElementById('dplayer'),
        video: {
            url: '{{$movies->content}}',
            type: 'customHls',
            customType: {
                customHls: function (video, player) {
                    const hls = new Hls();
                    hls.loadSource(video.src);
                    hls.attachMedia(video);
                },
            },
        },
    });

</script>
