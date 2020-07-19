<?php

namespace App\Models;

use App\Models\Article;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y, H:m'
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return Category::whereId($value)
            ->orWhere('slug', $value)
            ->firstOrFail();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_category');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
