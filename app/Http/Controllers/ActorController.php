<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * List all actors (WEB).
     */
    public function listActors()
    {
        $actors = Actor::all();
        $title = "Listado de todos los actores";
        
        return view('actors.list', compact('actors', 'title'));
    }

    /**
     * List actors by decade (WEB).
     */
    public function listActorsByDecade($year)
    {
        $endYear = $year + 9;

        $actors = Actor::whereYear('birthdate', '>=', $year)
                       ->whereYear('birthdate', '<=', $endYear)
                       ->get();
        
        $title = "Listado de actores nacidos en la década de $year";
        
        return view('actors.list', compact('actors', 'title'));
    }

/**
 * Count total actors (API).
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function countActorsApi()
{
    $count = Actor::count();

    return response()->json([
        'status' => true,
        'total_actors' => $count
    ]);
}

    /**
     * List all actors (API).
     */
    public function index()
    {
        $actors = Actor::all();

        return response()->json([
            'status' => true,
            'data' => $actors
        ]);
    }

    /**
     * List actors by decade (API).
     */
    public function actorsByDecade($year)
    {
        // Valid decades
        $validYears = [1980, 1990, 2000, 2010, 2020];

        if (!in_array($year, $validYears)) {
            return response()->json([
                'status' => false,
                'message' => 'Década no válida. Valores permitidos: 1980, 1990, 2000, 2010, 2020'
            ], 400);
        }

        $endYear = $year + 9;

        $actors = Actor::whereYear('birthdate', '>=', $year)
                       ->whereYear('birthdate', '<=', $endYear)
                       ->get();

        return response()->json([
            'status' => true,
            'decade' => "$year-$endYear",
            'count' => $actors->count(),
            'data' => $actors
        ]);
    }

    /**
     * Delete actor (API).
     */
    public function destroy($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return response()->json([
                'action' => 'delete',
                'status' => false,
                'message' => 'Actor not found'
            ], 404);
        }

        $status = $actor->delete();

        return response()->json([
            'action' => 'delete',
            'status' => $status
        ]);
    }

    /**
     * Delete actor (WEB).
     */
    public function delete($id)
    {
        $actor = Actor::find($id);

        if (!$actor) {
            return redirect()->back()->with('error', 'Actor no encontrado');
        }

        $actor->delete();

        return redirect()->back()->with('success', 'Actor eliminado correctamente');
    }
}