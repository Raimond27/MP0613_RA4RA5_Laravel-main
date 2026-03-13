    <?php

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

    Route::middleware('validate_year')->group(function() {
        Route::group(['prefix'=>'filmout'], function(){
            // Routes included with prefix "filmout"
            Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
            Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
            Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
            Route::get('count',[FilmController::class, "countFilms"])->name('countFilms');
        });
    });

    Route::middleware('year')->group(function() {
        Route::group(['prefix'=>'actorout'], function(){
            Route::get('listActorsByDecade/{year?}',[\App\Http\Controllers\ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
        });
    });

    // Rutas para añadir películas con middleware de validación de URL
    Route::middleware('validateurl')->group(function() {
        Route::group(['prefix'=>'filmin'], function(){
            // Routes included with prefix "filmin"
            Route::post('film',[FilmController::class, "createFilm"])->name('createFilm');
        });
    });


