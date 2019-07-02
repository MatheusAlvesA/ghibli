<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class PessoasController extends Controller
{
    /**
     * Show all the characters and movies
     */
    public function show(Request $r)
    {
		$fmt = $r->query('fmt');
		switch ($fmt) {
			case 'json':
				return response($this->getJoinedData()->get(), 200);
				break;
			case 'csv':
				return response('In development', 200)
						->header('Content-Type', 'text/plain');
				break;
			case 'html':
				return response('In development', 200)
						->header('Content-Type', 'text/plain');
				break;

			default:
				return response('Erro: insert the format (fmt=[json, csv, html])', 400)
						->header('Content-Type', 'text/plain');
				break;
		}

	}
	
	/**
     * Gets and joins all character data and your movies
     */
	private function getJoinedData() {
		return DB::table('characters')
		->join('movies_characters', 'characters.id', '=', 'movies_characters.character_id')
		->join('movies', 'movies.id', '=', 'movies_characters.movie_id')
		->select(
					'characters.name',
					'characters.age',
					'movies.name as movieName',
					'movies.year as movieYear',
					'movies.rtrate as rtScore'
		);
	}
}