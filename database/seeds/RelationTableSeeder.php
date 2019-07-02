<?php

use Illuminate\Database\Seeder;

class RelationTableSeeder extends Seeder
{
    /**
     * Seed the movies_characters table.
     *
     * @return void
     */
    public function run()
    {
		$moviesIds = [];
		foreach (DB::table('movies')->select('id')->get() as $value) {
			array_push($moviesIds, get_object_vars($value));
		}

		$charactersIds = [];
		foreach (DB::table('characters')->select('id')->get() as $value) {
			array_push($charactersIds, get_object_vars($value));
		}

		$smallerTable = $moviesIds;
		$bigestTable = $charactersIds;
		$smallerTableKey = 'movie_id';
		$bigestTableKey = 'character_id';
		if(count($moviesIds) >= count($charactersIds)) {
			$smallerTable = $charactersIds;
			$bigestTable = $moviesIds;
			$smallerTableKey = 'character_id';
			$bigestTableKey = 'movie_id';
		}

		foreach ($smallerTable as $key => $value) {
			DB::table('movies_characters')
			->insert([
						$smallerTableKey => $smallerTable[$key]['id'],
						$bigestTableKey	 => $bigestTable[$key]['id']
					]
			);
		}
    }
}
