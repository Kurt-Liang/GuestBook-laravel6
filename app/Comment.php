<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'comment'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function article()
    {
    return $this->belongsTo(Article::class);
    }
}
