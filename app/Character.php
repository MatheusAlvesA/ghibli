<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
	protected $table = 'characteres';

	protected $primaryKey = 'id';  // The primary key on DB
	public $incrementing = false;  // This key is not auto incrementing
	protected $keyType = 'string'; // The type of the primary key is string

	protected $fillable = ['id', 'name', 'age', 'eye_color', 'hair_color'];
}
