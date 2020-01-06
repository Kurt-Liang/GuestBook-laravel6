<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Stamp;
use Illuminate\Http\Request;
use Auth;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.index', ['articles' => 
            Article::where('id', '>', 0)->orderBy('id', 'desc')->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null(Auth::user())) {
            return redirect(route('login'));
        }
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video_url = $request->input('video_url');
        $http = substr($video_url, 0, 7);
        $https = substr($video_url, 0, 8);
        $end =  substr($video_url, -4);

        if (!empty($video_url)) {
            if ($http == "http://" or $https == "https://" and $end == ".mp4") {
                error_reporting(0);
                $html = file_get_contents($video_url);
                error_reporting(-1);
    
                if (empty($html)) {
                    $err = "Please enter the correct URL";
                    return view('articles.create', ['err' => $err]);
    
                } else {
                    $user = Auth::user();
                    $article = new Article;
                    $article->user = $user->name;
                    $article->title = $request->input('title');
                    $article->article = $request->input('article');
                    $article->video_url = $request->input('video_url');
                    $article->views = 0;
                    $article->user_id = $user->id;
                    $article->save();
                    return redirect(route('articles.index'));
                }
    
            } else {
                $err = "Please enter the correct URL";
                return view('articles.create', ['err' => $err]);
            }
        } else {
            $user = Auth::user();
            $article = new Article;
            $article->user = $user->name;
            $article->title = $request->input('title');
            $article->article = $request->input('article');
            $article->video_url = '';
            $article->views = 0;
            $article->user_id = $user->id;
            $article->save();
            return redirect(route('articles.index'));
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->views = $article->views + 1;
        $article->save();
        return view('articles.show', ['article' => $article, 
            'comments' => Comment::where('article_id', '=', $article->id)->get(),
            'stamps' => Stamp::where('article_id', '=', $article->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $user = Auth::user();
        if(is_null($user) || $user->cant('update', $article)){
            return redirect(route('articles.index'));
        }
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->article = $request->input('article');
        $article->save();
        return redirect(route('articles.show', ['article' => $article]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('articles.index'));
    }
}
