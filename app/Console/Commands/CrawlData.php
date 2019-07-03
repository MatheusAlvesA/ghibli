<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Crawler;

class CrawlData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data about characters and movies from Studio Ghibli and save it in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
		$this->info('Crawling data from the API...');

		$movies = Crawler::getAllMovies();
		$characters = Crawler::getAllPeople();
		Crawler::setMoviesOnDatabase($movies);
		Crawler::setPeopleOnDatabase($characters);

		Crawler::relationate($movies, $characters);

		$this->info('Success !!!');
    }
}
