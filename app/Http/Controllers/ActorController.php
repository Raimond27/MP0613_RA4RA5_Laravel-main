<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * List all actors using Eloquent.
     *
     * @return \Illuminate\View\View
     */
    public function listActors()
    {
        $actors = Actor::all();
        $title = "Listado de todos los actores";
        
        return view('actors.list', compact('actors', 'title'));
    }
}
