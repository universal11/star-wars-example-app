<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarshipController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GalaxyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/Starship/getByPilotName/{pilotName}", [StarshipController::class, "getByPilotName"]);

Route::get("/Film/getSpeciesClassificationsByEpisode/{episodeNumber}", [FilmController::class, "getSpeciesClassificationsByEpisode"]);

Route::get("/Galaxy/getTotalPopulation", [GalaxyController::class, "getTotalPopulation"]);

