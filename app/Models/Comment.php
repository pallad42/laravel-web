<?php

namespace App\Models;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content'
    ];

    protected $hidden = [
        'updated_at', 'article_id', 'author_id'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y, H:m'
    ];

    protected $with = [
        'replies'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
