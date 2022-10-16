<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class carriers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:quotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to check all carriers from json file';

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
        $response = Http::get('http://localhost:8000/api/quotes');

        dd(json_decode($response->getBody()->getContents()));
    }
}
