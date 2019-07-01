<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesCharacteresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_characters', function (Blueprint $table) {
			$table->string('movie_id', 150);
			$table->string('character_id', 150);
			
			$table->foreign('movie_id')->references('id')->on('movies');
			$table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('movies_characters', function (Blueprint $table) {
			$table->dropForeign('movies_characters_movie_id_foreign');
			$table->dropForeign('movies_characters_character_id_foreign');
		});
        Schema::dropIfExists('movies_characters');
    }
}
