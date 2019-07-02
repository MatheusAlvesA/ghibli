<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Character;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Character::class, function (Faker $faker) {
    return [
		'id' => Str::random(30),
		'name' => $faker->name,
		'age' => Str::random(10),
		'gender' => Str::random(6),
		'eye_color' => Str::random(5),
		'hair_color' => Str::random(5),
    ];
});
