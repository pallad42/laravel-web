<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $count = 10;

        for ($i = 0; $i < $count; $i++) {
            $article = factory(Article::class)->make();

            $user = User::all()->random();
            $article->author()->associate($user);

            $article->save();

            $category = Category::all()->random();
            $article->categories()->attach($category);
        }
    }
}
