<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ArticleModel::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'desc' => $faker->sentence
    ];
});
