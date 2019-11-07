<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\articles;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(articles::class, function (Faker $faker) {
    return [
        //
        "title" => $faker->sentence,
        "status" => $faker->numberBetween(1,4),
        "user_id" => \App\User::all()->random()->id
    ];
});
