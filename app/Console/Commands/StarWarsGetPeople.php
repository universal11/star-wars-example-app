<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use \Exception;

class StarWarsGetPeople extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'star-wars:get-people';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves a list of all people.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $starWarsApiClient = new StarWarsApiClient();
        try{
            $response = $starWarsApiClient->getPeople();
            $this->info($response->body());
        }
        catch(Exception $exception){
            $this->error("Failed to retrieve starships.");
            $this->error($exception->getMessage());
        }
    }
}
