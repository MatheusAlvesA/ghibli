<?php

namespace App;

use DB;

class Crawler
{
	const ENDPOINT = 'https://ghibliapi.herokuapp.com/';

	static function getAllMovies() {
		$raw = \file_get_contents(Crawler::ENDPOINT.'films/?limit=250');
		$data = \json_decode($raw, true);
		return $data;
	}

	static function getAllPeople() {
		$raw = \file_get_contents(Crawler::ENDPOINT.'people/?limit=250');
		$data = \json_decode($raw, true);
		return $data;
	}

	static function setMoviesOnDatabase($movies) {
		foreach($movies as $movie) {
			Crawler::insertMovieIfNotExists($movie);
		}
	}

	static private function insertMovieIfNotExists($movie) {
		$r = Movie::where('id', $movie['id'])->get();
		if(count($r) === 0) {
			Movie::create([
				'id'			=> $movie['id'],
				'name' 			=> $movie['title'],
				'description'	=> $movie['description'],
				'director'		=> $movie['director'],
				'producer'		=> $movie['producer'],
				'year'			=> $movie['release_date'],
				'rtrate'		=> $movie['rt_score'],
				]);
		}
	}

	static function setPeopleOnDatabase($characters) {
		foreach($characters as $char) {
			Crawler::insertCharIfNotExists($char);
		}
	}

	static private function insertCharIfNotExists($char) {
		$r = Character::where('id', $char['id'])->get();
		if(count($r) === 0) {
			Character::create([
				'id'			=> $char['id'],
				'name' 			=> $char['name'],
				'gender' 		=> $char['gender'],
				'age'			=> $char['age'],
				'eye_color'		=> $char['eye_color'],
				'hair_color'	=> $char['hair_color'],
				]);
		}
	}

	static function relationate($movies, $characters) {
		$relationateds = [];
		foreach($movies as $movie) {
			foreach(Crawler::extractCharsFromMovies($movie) as $char) {
				\array_push(
								$relationateds,
								[
									'movie_id'	=> $movie['id'],
									'character_id'	=> $char
								]
							);
			}
		}

		foreach($characters as $char) {
			foreach(Crawler::extractMoviesFromChars($char) as $movie) {
				$relation = [
								'movie_id'	=> $movie,
								'character_id'	=> $char['id']
							];
				if(!Crawler::alreadyRelated($relationateds, $relation)) {
					\array_push($relationateds,	$relation);
				}
			}
		}

		foreach ($relationateds as $relation) {
			$inDatabaseRelations = DB::select('SELECT * FROM movies_characters;');
			if(!Crawler::alreadyRelated($inDatabaseRelations, $relation)) {
				DB::connection()
				->statement(
							'INSERT INTO movies_characters (movie_id, character_id)
							 VALUES (:movie_id, :character_id);',
							$relation
						);
			}
		}
	}

	static private function alreadyRelated($all, $new) {
		foreach($all as $relation) {
			if(\gettype($relation) === 'object') {
				$relation = [
								'movie_id' => $relation->movie_id,
								'character_id' => $relation->character_id
							];
			}
			if($relation['movie_id'] === $new['movie_id'] &&
				$relation['character_id'] === $new['character_id']
			  ) {
				  return true;
			  }
		}
		return false;
	}

	static function extractCharsFromMovies($movie) {
		$characters = [];
		foreach($movie['people'] as $char) {
			$splited = explode('/', $char);
			$code = end($splited);
			if($code !== null && $code !== '') {
				\array_push($characters, $code);
			}
		}
		return $characters;
	}

	static function extractMoviesFromChars($chars) {
		$movies = [];
		foreach($chars['films'] as $movie) {
			$splited = explode('/', $movie);
			$code = end($splited);
			if($code !== null && $code !== '') {
				array_push($movies, $code);
			}
		}
		return $movies;
	}
}
