<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetSpeciesByEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-species-by-episode {episodeNumber : The episode number of the film.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves species by episode number.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $episodeNumber = $this->argument("episodeNumber");
        $this->info("Retrieving species for episode: {$episodeNumber}");
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $species = $starWarsApiClient->getSpeciesByEpisode($episodeNumber);
            $this->info(json_encode($species));
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve species by episode.");
            $this->error($exception->getMessage());
        }
    }
}
