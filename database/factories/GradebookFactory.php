<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gradebook;
use Faker\Generator as Faker;

$factory->define(Gradebook::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->numerify('IV #'),
        'teacher_id' => null        
    ];
});
