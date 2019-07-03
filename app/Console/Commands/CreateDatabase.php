<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:createDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the database without any table or data';

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
     * @return mixed
     */
    public function handle()
    {
		$dbName = env('DB_DATABASE', null);

        if ($dbName === null) {
            $this->error('Error, DB_DATABASE is empty, please check the .env file');
            return;
        }

        try {
			$pdo = new PDO(
							sprintf(
										'mysql:host=%s;port=%d;',
										env('DB_HOST', '127.0.0.1'),
										env('DB_PORT', '3306')
									),
							env('DB_USERNAME', 'root'),
							env('DB_PASSWORD', '')
						);
            $pdo->exec(
						sprintf(
                				'CREATE DATABASE IF NOT EXISTS %s CHARACTER SET UTF8;',
                				$dbName
						)
					);

            $this->info(sprintf('Successfully created %s database', $dbName));
        } catch (PDOException $exception) {
            $this->error(sprintf('Failed to create %s database, %s', $dbName, $exception->getMessage()));
        }
    }
}
