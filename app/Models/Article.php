<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content'
    ];

    protected $hidden = [
        'updated_at', 'author_id'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y, H:m'
    ];

    protected $with = [
        'author', 'categories'
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return Article::whereId($value)
            ->orWhere('slug', $value)
            ->firstOrFail();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getComments()
    {
        $comments = $this->comments;

        foreach($comments as $elementKey => $comment) {
            if($comment->parent_id != null){
                unset($comments[$elementKey]);
            }
        }

        return $comments;
    }
}
