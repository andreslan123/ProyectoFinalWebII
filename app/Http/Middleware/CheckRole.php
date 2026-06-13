<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verificamos si el usuario está autenticado y si su rol coincide con el requerido
        if ($request->user() && $request->user()->rol_id == $role) {
            return $next($request); // ¡Pasa! El usuario tiene el rol correcto
        }

        // Si no cumple, retornamos error 403 (Prohibido)
        return response()->json([
            'status' => false,
            'message' => 'Acceso denegado: No tienes permisos de administrador.'
        ], 403);
    }
}