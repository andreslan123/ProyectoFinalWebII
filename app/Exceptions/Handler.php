<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Convierte todas las excepciones a formato JSON uniforme:
     * { "status": false, "message": "...", "errors": {...} }
     */
    public function render($request, Throwable $e)
    {
        // Solo aplica a rutas de la API
        if ($request->is('api/*') || $request->expectsJson()) {

            // 422 — Error de validación
            if ($e instanceof ValidationException) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Error de validación',
                    'errors'  => $e->errors(),
                ], 422);
            }

            // 401 — No autenticado (token inválido o ausente)
            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No autenticado. Iniciá sesión para continuar.',
                ], 401);
            }

            // 404 — Modelo no encontrado (ej. Producto::findOrFail)
            if ($e instanceof ModelNotFoundException) {
                $modelo = class_basename($e->getModel());
                return response()->json([
                    'status'  => false,
                    'message' => "{$modelo} no encontrado.",
                ], 404);
            }

            // 404 — Ruta no encontrada
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Ruta no encontrada.',
                ], 404);
            }

            // 405 — Método HTTP no permitido
            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Método HTTP no permitido.',
                ], 405);
            }

            // 500 — Cualquier otro error inesperado
            return response()->json([
                'status'  => false,
                'message' => 'Error interno del servidor.',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }

        return parent::render($request, $e);
    }
}