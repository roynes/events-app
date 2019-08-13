<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'from' => Carbon::now()->timestamp,
        'to' => Carbon::now()->add(rand(0, 50), 'day')->timestamp
    ];
});
