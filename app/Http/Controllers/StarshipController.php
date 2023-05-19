<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use App\Classes\Response;
use \Exception;

class StarshipController extends Controller
{
    public function getByPilotName(Request $request, $pilotName){
        $starWarsApiClient = new StarWarsApiClient();
        $starships = [];
        try{
            $starships = $starWarsApiClient->getStarshipsByPilotName($pilotName);
        }
        catch(Exception $exception){
            return Response::initWithException($exception)->toJson();
        }
        return Response::initWithSuccess($starships)->toJson();
    }
}
