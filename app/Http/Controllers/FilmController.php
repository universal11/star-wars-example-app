<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use App\Classes\Response;
use \Exception;

class FilmController extends Controller
{
    public function getSpeciesClassificationsByEpisode(Request $request, $episodeNumber){
        $starWarsApiClient = new StarWarsApiClient();
        $classifications = [];
        try{
            $classifications = $starWarsApiClient->getSpeciesClassificationsByEpisode($episodeNumber);
        }
        catch(Exception $exception){
            return Response::initWithException($exception)->toJson();
        }
        return Response::initWithSuccess($classifications)->toJson();
    }
}
