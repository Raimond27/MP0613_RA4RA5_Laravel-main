<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/actors', [ActorController::class, 'index']);

Route::get('/actors/decade/{year}', [ActorController::class, 'actorsByDecade']);

Route::get('/actors/count', [ActorController::class, 'countActorsApi']);

Route::delete('/actors/{id}', [ActorController::class, 'destroy']);

Route::get('/films', [FilmController::class, 'index']);
