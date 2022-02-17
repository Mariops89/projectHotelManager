<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Acceso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $perfil_requerido = null)
    {
        $usuario = Auth::user();

        if ($request->route()->named('login')) {
            if (!is_null($usuario)) {
                return back();
            }
            return $next($request);

        } else {
            if (is_null($usuario)) {
                return redirect('login');
            }
        }

        if ($usuario->perfil !== 'administrador') {
            if ($perfil_requerido == 'administrador' || $perfil_requerido !== $usuario->perfil) {
                return back();
            }
        }


        return $next($request);
    }
}
