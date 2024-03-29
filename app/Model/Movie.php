<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	protected $table = 'movies';

	protected $primaryKey = 'id';  // The primary key on DB
	public $incrementing = false;  // This key is not auto incrementing
	protected $keyType = 'string'; // The type of the primary key is string

	public $timestamps = false;

	protected $fillable = ['id', 'name', 'description', 'director', 'producer', 'year', 'rtrate'];
}
