<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetStarshipsByPilotName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-starships-by-pilot-name {name : The name of the pilot}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves a list of starships by pilot.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument("name");
        $this->info("Retrieving starships for: {$name}");
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $starships = $starWarsApiClient->getStarshipsByPilotName($name);
            $this->info(json_encode($starships));
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve starships.");
            $this->error($exception->getMessage());
        }
    }
}
