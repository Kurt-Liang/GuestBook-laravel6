@extends("layouts.graffiti")

@section('current_articles', 'current_page_item');

@section("content")

<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a>Edit</a></h2>
            <form action="{{ route('articles.update', [ 'article' => $article]) }}" method="POST">
                @method('PUT')
                @csrf
                <div style="margin:5px 10px 15px 20px;">
                    <input type="text" name="title" placeholder="Title" value="{{ $article->title }}">
                </div>
                <div style="margin:5px 10px 15px 20px;">
                    <input type="text" name="video_mp4" placeholder="Please start with http:// or https:// and end with .mp4" size="60" value="{{ $article->video }}">
                </div>
                <div>
                    <textarea name="article" cols="70", rows="10">{{ $article->article }}</textarea>
                </div>
                <div class="entry">
                    <p class="links">
                        <input type="submit" value="Edit">
                        <form action="{{ route('articles.destroy', [ 'article' => $article]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Delete">
                        </form>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection