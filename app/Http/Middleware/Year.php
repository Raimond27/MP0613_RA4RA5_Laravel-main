<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Year
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $year = $request->route('year');
        $allowedDecades = [1980, 1990, 2000, 2010, 2020];

        if (isset($year)) {
            if (!is_numeric($year) || !in_array((int)$year, $allowedDecades)) {
                return redirect('/')->with('error', 'La década debe ser 1980, 1990, 2000, 2010 o 2020.');
            }
        }

        return $next($request);
    }
}
