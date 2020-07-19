<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $count = 10;

        for ($i = 0; $i < $count; $i++) {
            $comment = factory(Comment::class)->make();

            $user = User::all()->random();
            $comment->author()->associate($user);

            $article = Article::all()->random();
            $comment->article()->associate($article);

            $comment->save();
        }

        for ($j = 0; $j < $count; $j++) {
            $replyComment = factory(Comment::class)->make();

            $user = User::all()->random();
            $replyComment->author()->associate($user);

            $comment = Comment::all()->random();

            $article = $comment->article;
            $replyComment->article()->associate($article);

            if ($comment->parent_id == null) {
                $comment->replies()->save($replyComment);
            }

            $replyComment->save();
        }
    }
}
