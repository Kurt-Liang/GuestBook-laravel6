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
            </div>
            @foreach($comments as $comment)
                <HR style='border:1 dashed' width='100%' SIZE=1>
                <p class='meta'><span class='date'>{{ $comment->created_at }}</span><span class='posted'>Commented by <a>{{ $comment->user }}</a></span></p>
                <div class='entry'>
                    <p>{{ $comment->comment }}</p>
                    <p class='links'>
                        <div align="right">
                        @if (!empty(Auth::user()))
                            @if (Auth::user()->id == $comment->user_id)
                                <form action="{{ route('comments.destroy', [ 'comment' => $comment]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Delete">
                                </form>
                            @endif
                        @endif
                        </div>
                    </p>
                </div>
            @endforeach
            <div id="result"></div>

            @if (!empty(Auth::user()))
                <HR style='border:1 dashed' width='100%' SIZE=1>
                <form id="comment">
                    @csrf
                    <div>
                        <textarea id='text' cols='70', rows='10'></textarea>
                    </div>
                    <div class="form-group links">
                        <div id="error"></div><button class="btn btn-success index-submit">Comment</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
