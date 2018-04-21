<?php

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
    ];
});
