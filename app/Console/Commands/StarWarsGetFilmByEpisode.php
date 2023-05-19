<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetFilmByEpisode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-film-by-episode {episodeNumber : The episode number of the film.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves a film by episode number.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $episodeNumber = $this->argument("episodeNumber");
        $this->info("Retrieving film for: {$episodeNumber}");
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $film = $starWarsApiClient->getFilmByEpisode($episodeNumber);
            $this->info(json_encode($film));
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve film.");
            $this->error($exception->getMessage());
        }
    }
}
