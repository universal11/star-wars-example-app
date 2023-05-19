<?php

namespace App\Classes\StarWars;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use \Exception;

class ApiClient {

    public function __construct(){

    }

    public function getURLFromPath($path){
        return "https://swapi.dev/api/{$path}";
    }

    public function getStarships(){
        $url = $this->getURLFromPath("starships");
        $response = Http::get($url);
        $response->throw();
        return $response;
    }

    public function getPeople(){
        $url = $this->getURLFromPath("people");
        $response = Http::get($url);
        $response->throw();
        return $response;
    }

    public function getPersonByName($name){
        if($name == null || trim($name) == ""){
            throw new Exception("Invalid name provided");
        }
        $url = $this->getURLFromPath("people");
        $response = Http::get($url, [
            "search" => $name
        ]);
        $response->throw();
        return $response;
    }

    public function getStarshipsByPerson($person){
        $starships = [];
        try{
            foreach($person->starships as $starshipURL){
                $response = Http::get($starshipURL);
                $response->throw();
                $starships[] = $response->object();
            }
        }
        catch(Exception $exception){
            throw $exception;
        }
        return $starships;
    }

    public function getStarshipsByPilotName($name){
        $starships = [];
       
        try{
            $response = $this->getPersonByName($name);
            $data = $response->object();
            if( count($data->results) == 0 ){
                throw new Exception("Pilot not found.");
            }

            $person = $data->results[0];
            $starships = $this->getStarshipsByPerson($person);
            

        }
        catch(Exception $exception){
            throw $exception;
        }

        return $starships;
    }


}