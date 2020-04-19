<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'user_id' => 1        
    ];
});
