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
		$parsed = $this->parseToArray($data);
		$filtered = $this->applyFilter($parsed, $r);

		switch ($fmt) {
			case 'json':
				return response($filtered, 200);
				break;
			case 'csv':
				return response($this->formatToCSV($filtered), 200)
						->header('Content-Type', 'text/csv')
						->header('Content-Disposition', 'attachment; filename="pessoas.csv"');
				break;
			case 'html':
				return view('pessoas', ['data' => $filtered]);
				break;

			default:
				return response('Erro: insert the format (fmt=[json, csv, html])', 400)
						->header('Content-Type', 'text/plain');
				break;
		}

	}

	
	/**
	*	Returns all data filtred by the user request
	*/
	private function applyFilter($data, $r) {
		$filter = $r->query('filter');
		if($filter === null || $filter === '') {
			return $data;
		}
		$splited = explode(':', $filter);
		if(count($splited) !== 2) {
			return $data;
		}

		$key = $splited[0];
		$value = $splited[1];

		$filtered = [];
		foreach ($data as $char) {
			if(!array_key_exists($key, $char)) {
				return $data;
			}

			if($char[$key] === $value) {
				array_push($filtered, $char);
			}
		}

		return $filtered;
	}

	/**
	 * Parses a Collection to a associative array
	*/
	private function parseToArray($data) {
		$r = [];
		foreach ($data->get() as $value) {
			array_push($r, get_object_vars($value));
		}
		return $r;
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
			return $ordenated;
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
					'characters.name as name',
					'characters.age as age',
					'movies.name as movieName',
					'movies.year as movieYear',
					'movies.rtrate as rtScore'
		);
	}

	private function formatToCSV($data) {
		$keys = array_keys($data[0]);
		$header = '';
		foreach ($keys as $value) {
			$header .= $value.';';
		}
		$header = substr($header, 0, -1); // Removing last ';'
		$header .= "\n";

		$body = '';
		foreach ($data as $char) {
			foreach ($char as $value) {
				$body .= $value.';';
			}
			$body = substr($body, 0, -1); // Removing last ';'
			$body .= "\n";
		}

		return $header.$body;
	}
}