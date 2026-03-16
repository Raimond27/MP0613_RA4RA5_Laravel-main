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

    /**
     * List actors by birthdate decade.
     *
     * @param int $year The starting year of the decade.
     * @return \Illuminate\View\View
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
     * Count total actors.
     *
     * @return \Illuminate\View\View
     */
    public function countActors()
    {
        $count = Actor::count();
        return view('actors.count', compact('count'));
    }

    /**
     * Remove the specified actor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
}
