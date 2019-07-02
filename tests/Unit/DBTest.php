<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;

class DBTest extends TestCase
{
    /**
     * Test if the characters table are populated
     *
     * @return void
	 * @test
     */
    public function characteresPopulatedTest()
    {
		$r = DB::table('characters')->select('*')->get();
        $this->assertTrue(count($r) > 0);
	}
	
	/**
     * Test if the movies table are populated
     *
     * @return void
	 * @test
     */
    public function moviesPopulatedTest()
    {
		$r = DB::table('movies')->select('*')->get();
        $this->assertTrue(count($r) > 0);
	}
	
	/**
     * Test if the characters table are populated
     *
     * @return void
	 * @test
     */
    public function relationTablePopulatedTest()
    {
		$r = DB::table('movies_characters')->select('*')->get();
        $this->assertTrue(count($r) > 0);
    }
}
