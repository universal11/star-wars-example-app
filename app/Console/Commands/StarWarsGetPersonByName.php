<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetPersonByName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-person-by-name {name : The name of the person}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves person by name.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument("name");
        $this->info("Retrieving: {$name}");
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $response = $starWarsApiClient->getPersonByName($name);
            $this->info($response->body());
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve person.");
            $this->error($exception->getMessage());
        }
    }
}
