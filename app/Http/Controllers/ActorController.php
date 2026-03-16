<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
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
