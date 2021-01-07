<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shiporder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Shiporder::class, function (Faker $faker) {
    return [
        'person_id' => function () {
            return factory(App\Person::class)->create()->id;
        },
        'shipto_name' => $faker->name,
        'shipto_address' => $faker->address,
        'shipto_city' => $faker->city,
        'shipto_country' => $faker->country
    ];
});
