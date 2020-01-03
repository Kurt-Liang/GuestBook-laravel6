@extends("layouts.graffiti")

@section('current_post', 'current_page_item');

@section("content")

<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a>Create</a></h2>
            <form class="form" action="{{ route('articles.store') }}", method="post">
                @csrf
                <div style="margin:5px 10px 15px 20px;">
                    <input type="text" name="title" placeholder="Title">
                </div>
                <div style="margin:5px 10px 15px 20px;">
                    <input type="text" name="video_url" placeholder="Please start with http:// or https:// and end with .mp4" size="60">
                </div>

                @if (!empty($err))
                    <div style="margin:5px 10px 15px 20px;">
                        {{ $err }}
                    </div>
                @endif

                <div>
                    <textarea name="article" cols="70", rows="10"></textarea>
                </div>
                <div class="entry">
                    <p class="links"><input type="submit" value="Create"></p>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
