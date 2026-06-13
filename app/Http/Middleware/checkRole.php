<?php
namespace App\Http\Middleware;
use Closure;
class CheckRole {
    public function handle($request, Closure $next, ...$roles) {
        if (!$request->user() || !in_array((int) $request->user()->rol_id, array_map('intval', $roles))) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        return $next($request);
    }
}