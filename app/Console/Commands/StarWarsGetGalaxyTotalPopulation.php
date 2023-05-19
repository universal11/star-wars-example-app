<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetGalaxyTotalPopulation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-galaxy-total-population';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves total population of all planets in the galaxy.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $totalPopulation = $starWarsApiClient->getGalaxyTotalPopulation();
            $this->info("Total Population: {$totalPopulation}");
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve total population.");
            $this->error($exception->getMessage());
        }
    }
}
