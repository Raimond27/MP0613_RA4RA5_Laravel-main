<?php

    use App\Http\Controllers\ActorController;
    use App\Http\Controllers\FilmController;
    use App\Http\Middleware\ValidateYear;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('year')->group(function() {
        Route::group(['prefix'=>'filmout'], function(){
            // Routes included with prefix "filmout"
            Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
            Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
            Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
            Route::get('count',[FilmController::class, "countFilms"])->name('countFilms');
        });

        Route::group(['prefix'=>'actorout'], function(){
            // Routes included with prefix "actorout"
            Route::get('actors', [ActorController::class, "listActors"])->name('listActors');
            Route::get('listActorsByDecade/{year}', [ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
            Route::get('countActors', [ActorController::class, "countActors"])->name('countActors');
        });
    });

    // Rutas para añadir películas con middleware de validación de URL
    Route::middleware('validateurl')->group(function() {
        Route::group(['prefix'=>'filmin'], function(){
            // Routes included with prefix "filmin"
            Route::post('film',[FilmController::class, "createFilm"])->name('createFilm');
        });
    });


