<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use DB;

class PessoasController extends Controller
{
    /**
     * Show all the characters and movies
     */
    public function show(Request $r)
    {
		$fmt = $r->query('fmt');

		$data = $this->getOrdenatedData($r);

		switch ($fmt) {
			case 'json':
				return response($data->get(), 200);
				break;
			case 'csv':
				return response($this->formatToCSV($data->get()), 200)
						->header('Content-Type', 'text/csv')
						->header('Content-Disposition', 'attachment; filename="pessoas.csv"');
				break;
			case 'html':
				return response('In development...', 200)
						->header('Content-Type', 'text/plain');
				break;

			default:
				return response('Erro: insert the format (fmt=[json, csv, html])', 400)
						->header('Content-Type', 'text/plain');
				break;
		}

	}

	/**
	*	Returns all data ordenated by the user request
	*/
	private function getOrdenatedData($r) {
		$sort = $r->query('sort');
		$order = $r->query('order');
		$data = $this->getJoinedData();
		if($sort === null) {
			return $data;
		}

		if($order !== 'desc' && $order !== 'asc') {
			$order = 'desc'; // Default ordening
		}

		try {
			$ordenated = $data->orderBy($sort, $order);
			$ordenated->get(); // Testing if this is a valid ordenation
		} catch(QueryException $e) {
			return $this->getJoinedData();
		}

		return $data;
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

	private function formatToCSV($data) {
		$keys = array_keys(get_object_vars($data[0]));
		$header = '';
		foreach ($keys as $value) {
			$header .= $value.';';
		}
		$header = substr($header, 0, -1); // Removing last ';'
		$header .= "\n";

		$body = '';
		foreach ($data as $char) {
			foreach (get_object_vars($char) as $value) {
				$body .= $value.';';
			}
			$body = substr($body, 0, -1); // Removing last ';'
			$body .= "\n";
		}

		return $header.$body;
	}
}