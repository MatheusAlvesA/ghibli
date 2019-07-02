<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Seed the characters table.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Model\Movie::class, 50)->create();
    }
}
