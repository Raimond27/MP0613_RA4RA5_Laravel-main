<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
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
        // Verificar si existe el parámetro img_url en la petición
        if ($request->has('img_url')) {
            $url = $request->input('img_url');
            
            // Validar que la URL sea correcta usando filter_var
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                // Si la URL no es válida, redirigir a la página de bienvenida con un error
                return redirect('/')->with('error', 'La URL de la imagen no es válida');
            }
        }
        
        // Si todo está correcto, continuar con la petición
        return $next($request);
    }
}
