<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class database extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:createdb-gameover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to create the database';

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
     * @return int
     */
    public function handle()
    {
        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS Gameover CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

        DB::statement($query);

        config(["database.connections.mysql.database" => 'Gameover']);
    }
}