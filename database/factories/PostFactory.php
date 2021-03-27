<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => auth()->id(),
        'title' => $faker->title,
        'slug' => $faker->slug,
        'summary' => $faker->text,
        'content' => $faker->sentence,
    ];
});
