<?php
$newers = DB::table('articles')->where('deleted_at', '=', null)->orderBy('id', 'desc')->limit(5)->get();
$populars = DB::table('articles')->where('deleted_at', '=', null)->orderBy('views', 'desc')->limit(5)->get();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Graffiti
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20111223

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>GuestBook</title>
<link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" media="screen" />
<link href="http://fonts.googleapis.com/css?family=Ruthie" rel="stylesheet" type="text/css" />
<link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    .vertical-menu {
		width:600px;
		height:200px;
		overflow-y:auto;
		margin-left:9px;
	}
			
	.vertical-menu input {
		background-color:#eee;
		color:black;
		padding:10px;
		text-decoration:none;
		width:240;
		height:180;
		vertical-align:top;
	}
			
	.vertical-menu input:hover {
		background-color:#ccc;
	}
			
	.vertical-menu input.active {
		background-color:#4ACF50;
		color:white;
	}
</style>

</head>
<body>
<div id="wrapper">
	<div id="wrapper-bgtop">
		<div id="wrapper-bgbtm">
			<div id="header" class="container">
				<div id="logo">
					<h1><a href="/">GuestBook</a></h1>
					<p>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a></p>
				</div>
				<div id="menu">
					<ul>
						<li class="@yield('current_announcement')"><a href="/">Announcement</a></li>
						<li class="@yield('current_articles')"><a href="/articles">Articles</a></li>
						<li class="@yield('current_post')"><a href="/articles/create">Post</a></li>
						<li class="@yield('current_home')")><a href="/home">Home</a></li>
					</ul>
				</div>
			</div>
			<!-- end #header -->
			<div id="page" class="container">
				<div id="content">
					@yield('content')
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
							<div id="search" >
								<form method="get" action="#">
									<div>
										<input type="text" name="s" id="search-text" value="" />
										<input type="submit" id="search-submit" value="GO" />
									</div>
								</form>
							</div>
							<div style="clear: both;">&nbsp;</div>
						</li>
						<li>
							<h2>Aliquam tempus</h2>
							<p>Mauris vitae nisl nec metus placerat perdiet est. Phasellus dapibus semper consectetuer hendrerit.</p>
						</li>
						<li>
							<h2>Categories</h2>
							<ul>
								<?php 
								foreach ($newers as $newer)
								{
									echo "<li><a href='/articles/$newer->id'>$newer->title</a></li>";
								}	
								?>
							</ul>
						</li>
						<li>
							<h2>More popular articles</h2>
							<ul>
								<?php 
								foreach ($populars as $popular)
								{
									echo "<li><a href='/articles/$popular->id'>$popular->title</a></li>";
								}	
								?>
							</ul>
						</li>
					</ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #page -->
		</div>
	</div>
</div>
<div id="footer">
	<p>&copy; Untitled. All rights reserved. Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>

<link href="/css/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.6.6/video.js"></script>

<script src="https://cdn.dashjs.org/latest/dash.all.min.js"></script>
<script src="js/videojs-dash.min.js"></script>


@if (!empty($article->video_url))
<script>
    const player = videojs('my-video',{
        sources:[{ src: "{{ $article->video_url }}"}],
		autoplay:true,
        loop:true,
        muted:false,
        width:"540",
        height:"303",
        controls:true
    });

	function stamp(time){
		player.currentTime(time);
	}

	function stamp_url(){
		window.location.href = "/stamps/{{ $article->id }}/edit";
	}
</script>
@endif

<script>
    var player = videojs('example-video',{
        sources:[{ src: "http://52.76.68.99/live/myStream/manifest.mpd"}],
        muted:true,
        width:"540",
        height:"303",
        controls:true
    });
    setTimeout(function(){
        if (player["hasStarted_"] == false) {
            player.error({message: "OFFLINE"});
        }
    }, 2000);
    player.play();
</script>