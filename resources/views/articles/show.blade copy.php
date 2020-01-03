<link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>

@extends('layouts.graffiti')

@section('current_articles', 'current_page_item');

@section('content')

<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a href="#">{{ $article->title }}</a></h2>
            <p class="meta"><span class="date">{{ $article->created_at }}</span><span class="posted">Posted by <a href="#">{{ $article->user }}</a></span></p>
            
            @if (!empty($article->video_url))
                <video id="my-video" class='video-js vjs-big-play-centered' controls preload="auto" height="303" width="540" autoplay=true muted=true data-setup="{}">
                    <source src="{{ $article->video_url }}" type="video/mp4" />
                </video>
            @endif
            
            <div class="entry">
                <p>{{ $article->article }}</p>
                Views : <strong>{{ $article->views }}</strong><p class="links">
                    
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->id == $article->user_id)
                            <a href='{{ $article->id }}/edit' title='b0x' class='comments'>Edit</a>
                        @endif

                    @endif

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

                    @if (!empty(Auth::user()))
                        <HR style='border:1 dashed' width='100%' SIZE=1>
                        <form class='form' action="{{ route('comments.store') }}?id={{ $article->id }}", method='post'>
                             @csrf
                            <div>
                                <textarea name='comment' cols='70', rows='10'></textarea>
                            </div>
                            <div class='entry'>
                                <p class='links'><input type='submit' name='submit' value='Comment'></p>
                            </div>
                        </form>
                    @endif

                </p>
            </div>
        </div>
    </div>
</div>


@endsection


