@extends('layouts.graffiti')

@section('current_announcement', 'current_page_item')

@section('content')

<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a href="#">LIVE</a></h2>
            <p class="meta"><span class="date">December 28, 2011</span><span class="posted">Posted by <a href="#">Someone</a></span></p>
            <div class="entry">
                <video id=example-video class="video-js vjs-big-play-button"> </video>
                <p>This is <strong>Graffiti</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.  This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you’re pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :)</p>
                <p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem.</p>
                <p class="links"><a href="#" class="more">Read More</a><a href="#" title="b0x" class="comments">Comments</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

