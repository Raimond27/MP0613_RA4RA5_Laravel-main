<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
{
    public function listActorsByDecade($year)
    {
        $startYear = (int) $year;
        $endYear = $startYear + 9;

        // Recuperar los actores cuya fecha de nacimiento esté en la década
        $actors = Actor::whereYear('birthdate', '>=', $startYear)
                       ->whereYear('birthdate', '<=', $endYear)
                       ->get();

        return view('actors.list', ['actors' => $actors, 'year' => $year]);
    }
}
