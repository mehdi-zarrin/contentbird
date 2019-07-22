<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'result' => json_encode([
            'title' => $faker->title,
            'images' => $faker->randomNumber(2),
            'internalLinks' => $faker->randomNumber(2),
            'externalLinks' => $faker->randomNumber(2)
        ]),
    ];
});
