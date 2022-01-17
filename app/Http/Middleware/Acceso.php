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
    public function handle(Request $request, Closure $next)
    {
        $usuario = Auth::user();

        if ($request->route()->named('login')) {
            if (!is_null($usuario)) {
                return back();
            }
        } else {
            if (is_null($usuario)) {
                return redirect('login');
            }
        }

        return $next($request);
    }
}
