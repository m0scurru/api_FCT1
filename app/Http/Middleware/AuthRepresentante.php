<?php

namespace App\Http\Middleware;

use App\Auxiliar\Auxiliar;
use App\Auxiliar\Parametros;
use Closure;
use Illuminate\Http\Request;

class AuthRepresentante
{
    /**
     * Permite el paso a los usuarios con perfil de trabajador y rol de representante legal
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @author Dani J. Coello <daniel.jimenezcoello@gmail.com>
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->tipo == 'trabajador') {
            if (in_array(Parametros::REPRESENTANTE_LEGAL, Auxiliar::getRolesTrabajadorFromEmail($request->user()->email))) {
                return $next($request);
            }
        } else {
            return response()->json(['message' => 'Acceso no autorizado'], 401);
        }
    }
}
