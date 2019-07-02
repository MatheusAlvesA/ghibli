<?php

use Illuminate\Database\Seeder;

class CharactereTableSeeder extends Seeder
{
    /**
     * Seed the characters table.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Model\Character::class, 50)->create();
    }
}
