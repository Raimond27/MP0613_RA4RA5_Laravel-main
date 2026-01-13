<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
 
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis (por año descendente)";
        $films = FilmController::readFilms();

        // Ordenar las películas por año descendente
        usort($films, function($a, $b) {
            return $b['year'] <=> $a['year'];
        });

        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        // Construir el título según los filtros aplicados
        if (!is_null($year) && is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por año: $year";
        } else if (is_null($year) && !is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por categoría: $genre";
        } else if (!is_null($year) && !is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por año: $year y categoría: $genre";
        }

        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    /**
     * Verifica si una película ya existe en el archivo JSON
     * 
     * @param string $filmName Nombre de la película a buscar
     * @return bool true si existe, false si no existe
     */
    public function isFilm($filmName)
    {
        $films = FilmController::readFilms();
        
        foreach ($films as $film) {
            // Comparación case-insensitive del nombre
            if (strtolower($film['name']) == strtolower($filmName)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Crea una nueva película y la guarda en el archivo JSON
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFilm(\Illuminate\Http\Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'genre' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'duration' => 'required|integer|min:1',
            'img_url' => 'required|url'
        ]);

        // Obtener el nombre de la película
        $filmName = $request->input('name');

        // Verificar si la película ya existe
        if ($this->isFilm($filmName)) {
            // Si existe, redirigir con mensaje de error
            return redirect('/')->with('error', 'La película "' . $filmName . '" ya existe en la base de datos');
        }

        // Si no existe, agregar la película
        $films = FilmController::readFilms();
        
        // Crear el array con los datos de la nueva película
        $newFilm = [
            'name' => $request->input('name'),
            'year' => (int)$request->input('year'),
            'genre' => $request->input('genre'),
            'country' => $request->input('country'),
            'duration' => (int)$request->input('duration'),
            'img_url' => $request->input('img_url')
        ];

        // Agregar la nueva película al array
        $films[] = $newFilm;

        // Guardar el array actualizado en el archivo JSON
        Storage::put('/public/films.json', json_encode($films, JSON_PRETTY_PRINT));

        // Redirigir con mensaje de éxito
        return redirect('/')->with('success', 'La película "' . $filmName . '" se ha añadido correctamente');
    }
}
