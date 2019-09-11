<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id'   => 1,
        'title' 	=> $title,
        'body'		=> $faker->text(800)
    ];
});
