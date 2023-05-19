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

    public function getFilms(){
        $url = $this->getURLFromPath("films");
        $response = Http::get($url);
        $response->throw();
        return $response;
    }

    public function getPlanets(){
        $url = $this->getURLFromPath("planets");
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

    public function getFilmByEpisode($episodeId){
        $filteredFilm = null;
       
        try{
            $response = $this->getFilms();
            $data = $response->object();
            $films = $data->results;
            foreach($films as $film){
                if($film->episode_id == $episodeId){
                    $filteredFilm = $film;
                    break;
                }
            }

        }
        catch(Exception $exception){
            throw $exception;
        }

        return $filteredFilm;
    }

    public function getSpeciesByFilm($film){
        $species = [];
        try{
            foreach($film->species as $speciesURL){
                $response = Http::get($speciesURL);
                $response->throw();
                $species[] = $response->object();
            }
        }
        catch(Exception $exception){
            throw $exception;
        }
        return $species;
    }

    public function getSpeciesByEpisode($episodeNumber){
        $species = [];
       
        try{
            $film = $this->getFilmByEpisode($episodeNumber);
            if( $film == null){
                throw new Exception("Film not found.");
            }

            $species = $this->getSpeciesByFilm($film);

        }
        catch(Exception $exception){
            throw $exception;
        }

        return $species;
    }

    public function getSpeciesClassificationsByEpisode($episodeNumber){
        $classifications = [];
       
        try{
            $film = $this->getFilmByEpisode($episodeNumber);
            if( $film == null){
                throw new Exception("Film not found.");
            }

            $species = $this->getSpeciesByFilm($film);
            foreach($species as $specimen){
                $classifications[] = $specimen->classification;
            }

        }
        catch(Exception $exception){
            throw $exception;
        }

        return $classifications;
    }

    public function getTotalPopulationOfPlanets($planets){
        $totalPopulation = 0;
        foreach($planets as $planet){
            if($planet->population != "unknown"){
                $totalPopulation += (int)$planet->population;
            }
        }
        return $totalPopulation;
    }

    public function getGalaxyTotalPopulation(){
        $totalPopulation = 0;
        try{
            $response = $this->getPlanets();
            $data = $response->object();
            $planets = $data->results;
            $totalPopulation += $this->getTotalPopulationOfPlanets($planets);
            $nextPlanetListPageURL = $data->next;
            while($nextPlanetListPageURL != null){
                $response = Http::get($nextPlanetListPageURL);
                $response->throw();
                $data = $response->object();
                $planets = $data->results;
                $totalPopulation += $this->getTotalPopulationOfPlanets($planets);
                $nextPlanetListPageURL = $data->next;
            }


        }
        catch(Exception $exception){
            throw $exception;
        }
        return $totalPopulation;
    }

}