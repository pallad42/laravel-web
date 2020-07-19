<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->company(),
        'content' => $faker->paragraph(50),
        'views' => rand(0, 1000),
        'created_at' => $faker->dateTimeThisYear()
    ];
});
