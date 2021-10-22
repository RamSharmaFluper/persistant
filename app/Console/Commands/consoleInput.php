<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\RouterController;
use RoutersTableSeeder;


class consoleInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'input:create {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Routers';

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
    public function handle(RoutersTableSeeder $seeder)
    {
        $value = $this->argument('number');
        $seeder->run($value);

        // echo $value;
    }
}
