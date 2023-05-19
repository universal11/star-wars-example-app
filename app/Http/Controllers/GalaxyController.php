<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;
use App\Classes\Response;
use \Exception;

class GalaxyController extends Controller
{
    public function getTotalPopulation(Request $request){
        $starWarsApiClient = new StarWarsApiClient();
        $totalPopulation = null;
        try{
            $totalPopulation = $starWarsApiClient->getGalaxyTotalPopulation();
        }
        catch(Exception $exception){
            return Response::initWithException($exception)->toJson();
        }
        return Response::initWithSuccess($totalPopulation)->toJson();
    }
}
