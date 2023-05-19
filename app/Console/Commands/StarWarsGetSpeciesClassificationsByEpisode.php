<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetSpeciesClassificationsByEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-species-classifications-by-episode {episodeNumber : The episode number of the film.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves species classifications by episode number.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $episodeNumber = $this->argument("episodeNumber");
        $this->info("Retrieving species classifications for episode: {$episodeNumber}");
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $classifications = $starWarsApiClient->getSpeciesClassificationsByEpisode($episodeNumber);
            $this->info(json_encode($classifications));
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve species classifications by episode.");
            $this->error($exception->getMessage());
        }
    }
}
