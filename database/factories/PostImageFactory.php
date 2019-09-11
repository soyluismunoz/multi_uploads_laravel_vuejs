<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostImage;
use App\Post;
use Faker\Generator as Faker;

$factory->define(PostImage::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'post_id'               => rand(1,30),
        'post_image_path' 	    => $title,
        'post_image_caption'    => $faker->imageUrl($width = 1200, $height=400)
    ];
});
