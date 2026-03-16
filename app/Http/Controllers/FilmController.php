<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * List old films (before a certain year).
     *
     * @param int|null $year
     * @return \Illuminate\View\View
     */
    public function listOldFilms($year = null)
    {        
        if (is_null($year)) {
            $year = 2000;
        }
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = Film::where('year', '<', $year)->get()->toArray();

        return view('welcome', ["films" => $films, "title" => $title]);
    }
    
    /**
     * List new films (since a certain year).
     *
     * @param int|null $year
     * @return \Illuminate\View\View
     */
    public function listNewFilms($year = null)
    {
        if (is_null($year)) {
            $year = 2000;
        }

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = Film::where('year', '>=', $year)->get()->toArray();

        return view('welcome', ["films" => $films, "title" => $title]);
    }
 
    /**
     * List all films, optionally filtered by year or genre.
     *
     * @param int|null $year
     * @param string|null $genre
     * @return \Illuminate\View\View
     */
    public function listFilms($year = null, $genre = null)
    {
        $query = Film::orderBy('year', 'desc');

        if (!is_null($year) && is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por año: $year";
            $query->where('year', $year);
        } else if (is_null($year) && !is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por categoría: $genre";
            $query->where('genre', $genre);
        } else if (!is_null($year) && !is_null($genre)) {
            $title = "Listado de todas las pelis filtrado por año: $year y categoría: $genre";
            $query->where('year', $year)->where('genre', $genre);
        } else {
            $title = "Listado de todas las pelis (por año descendente)";
        }

        $films = $query->get()->toArray();

        return view("welcome", ["films" => $films, "title" => $title]);
    }

    /**
     * Checks if a film already exists in the database.
     * 
     * @param string $filmName
     * @return bool
     */
    public function isFilm($filmName)
    {
        return Film::where('name', $filmName)->exists();
    }

    /**
     * Creates a new film in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFilm(Request $request)
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

        $filmName = $request->input('name');

        // Verificar si la película ya existe
        if ($this->isFilm($filmName)) {
            return redirect('/')->with('error', 'La película "' . $filmName . '" ya existe en la base de datos');
        }

        // Crear la película usando el modelo
        Film::create($request->all());

        return redirect()->route('listFilms')->with('success', 'La película "' . $filmName . '" se ha añadido correctamente');
    }

    /**
     * Return view with total films count.
     *
     * @return \Illuminate\View\View
     */
    public function countFilms()
    {
        $total = Film::count();
        return view('welcome', ["total" => $total]);
    }

    /**
     * API: List all films with their associated actors.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $films = Film::with('actors')->get();
        return response()->json($films);
    }
}
