<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(60),
        'slug' => $faker->slug(),
        'short_description' => $faker->text(50),
        'description' => $faker->text(100),
        'status' => $faker->boolean(),
    ];
});
