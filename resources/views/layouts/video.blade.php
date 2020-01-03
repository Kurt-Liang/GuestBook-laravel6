<link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
<div align="center">
<video id='my-video' class='video-js vjs-big-play-centered'></video>
</div>
<script>
    const player = videojs('my-video',{
        sources:[{ src: "{{ $article->video_url }}"}],
		autoplay:true,
        loop:true,
        muted:true,
        width:"540",
        height:"303",
        controls:true
    });
</script>