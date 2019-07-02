<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;

class ResponseTest extends TestCase
{
	/** @test */
    public function APITest()
    {
		$names = DB::table('characters')->select('name', 'age')->get();
		$this->get('/pessoas?fmt=json')
			->assertStatus(200)
			->assertJsonFragment([
									'name' => $names[0]->name,
									'age' => $names[0]->age
								]);

		$this->get('/pessoas?fmt=csv')
			->assertStatus(200);

		$this->get('/pessoas?fmt=html')
			->assertStatus(200);

		$this->get('/pessoas')
			->assertStatus(400);
    }
}
