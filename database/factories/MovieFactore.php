<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Movie;
use Illuminate\Support\Str;

$factory->define(Movie::class, function () {
    return [
		'id'			=> Str::random(30),
		'name' 			=> Str::random(10),
		'description' 	=> Str::random(10),
		'director' 		=> Str::random(6),
		'producer' 		=> Str::random(5),
		'year'			=> Str::random(4),
		'rtrate'		=> Str::random(2),
    ];
});
