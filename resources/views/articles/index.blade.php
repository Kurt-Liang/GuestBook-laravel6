<link  rel="stylesheet" type="text/css" href="{{asset('css/paging.css')}}"/>

@extends('layouts.graffiti')

@section('current_articles', 'current_page_item');

@section('content')

@foreach($articles as $article)
<div class="post">
    <div class="post-bgtop">
        <div class="post-bgbtm">
            <h2 class="title"><a href="#">{{ $article->title }}</a></h2>
            <p class="meta"><span class="date">{{ $article->created_at }}</span><span class="posted">Posted by <a href="#">{{ $article->user }}</a></span></p>
            <div class="entry">
                <p>{{ substr($article->article, 0, 200) }}...</p>
                <p class="links"><a href="/articles/{{ $article->id }}" class="more">Read More</a></p>
            </div>
        </div>
    </div>
</div>
@endforeach
{!! $articles->links() !!}
@endsection