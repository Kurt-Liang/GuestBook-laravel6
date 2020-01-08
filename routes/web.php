<?php
date_default_timezone_set("Asia/Taipei");
use App\Article;
use App\Comment;
use App\Stamp;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('articles', 'ArticleController');

Route::resource('comments', 'CommentController');

Route::get('/live', function () {
    return view('live');
});