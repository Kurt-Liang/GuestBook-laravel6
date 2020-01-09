<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class AjaxController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function ajaxRequestPost(Request $request)
    {
        date_default_timezone_set("Asia/Taipei");
        $t=time();
        $time = (date("Y-m-d H:i",$t));
        $text = $_POST["text"]; //取得 text POST 值
        $id = $_POST["id"];
        $user = Auth::user();

        if ($text != null) {
            $comment = new Comment;
            $comment->user = $user->name;
            $comment->comment = $text;
            $comment->user_id = $user->id;
            $comment->article_id = $id;
            $comment->save();

            return response()->json([
                'time'=>$time,
                'user'=>$user->name,
                'text'=>$text
            ]);
        } else {
            return response()->json([
                'errorMsg' => 'Please enter text'
            ]);
        }
    }
}
