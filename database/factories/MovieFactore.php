<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Movie;
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

$factory->define(Movie::class, function () {
    return [
		'id' => Str::random(30),
		'name' => Str::random(10),
		'description' => Str::random(10),
		'director' => Str::random(6),
		'producer' => Str::random(5),
		'year' => Str::random(4),
		'rtrate' => Str::random(2),
    ];
});
