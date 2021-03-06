@extends('layouts.graffiti')

@section('current_articles', 'current_page_item');

@section('content')

<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a>{{ $article->title }}</a></h2>
            <p class="meta"><span class="date">{{ $article->created_at }}</span><span class="posted">Posted by <a href="#">{{ $article->user }}</a></span></p>
            
            @if (!empty($article->video_url))
                <video id='my-video' class='video-js vjs-big-play-centered'></video>
            @endif

            @if (!empty($stamps[0]))
                <div class='vertical-menu'>
                @foreach ($stamps as $stamp)
                    <input type='image' onclick="stamp({{$stamp->time}})" src="{{ $stamp->image }}">
                @endforeach
                </div>
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
                    <div id="result"></div>

                    @if (!empty(Auth::user()))
                        <HR style='border:1 dashed' width='100%' SIZE=1>
                        <form id="comment">
                             @csrf
                            <div>
                                <textarea id='text' cols='70', rows='10'></textarea>
                            </div>
                            <div class="form-group links">
                                <div id="error"></div><button class="btn btn-success btn-submit">Comment</button>
                            </div>
                        </form>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>


@endsection



