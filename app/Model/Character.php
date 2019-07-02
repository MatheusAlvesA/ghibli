<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
	protected $table = 'characters';

	protected $primaryKey = 'id';  // The primary key on DB
	public $incrementing = false;  // This key is not auto incrementing
	protected $keyType = 'string'; // The type of the primary key is string
	public $timestamps = false;

	protected $fillable = ['id', 'name', 'gender', 'age', 'eye_color', 'hair_color'];
}
