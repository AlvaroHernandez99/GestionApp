<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class VerifyId
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
        //Crear un middleware que asegure que el id de las rutas es numérico, entero y positivo.
        //1. coger el id
        $id = $request->id;
        //2. validar
        if (!is_numeric($id) || $id < 0 || !($id/1 == $id)){
            return response('error', 422);
        }
        //3. dejar seguir o tirar hacia atrás
        return $next($request);
    }

}
