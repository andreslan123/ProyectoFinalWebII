<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\AuthController;

// ============================================================
// RUTAS PÚBLICAS (sin login — Catálogo para visitantes)
// ============================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Catálogo visible para todos (clientes navegando de forma anónima)
Route::apiResource('categorias',  CategoriaController::class)->only(['index', 'show']);
Route::apiResource('marcas',      MarcaController::class)->only(['index', 'show']);
Route::apiResource('productos',   ProductoController::class)->only(['index', 'show']);
Route::apiResource('promociones', PromocionController::class)->only(['index', 'show']);


// ============================================================
// RUTAS PROTEGIDAS — requieren login (cualquier rol válido)
// ============================================================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Devuelve el usuario autenticado actual (para mantener sesión al recargar)
    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => true,
            'data'   => $request->user()->load('rol', 'estado'),
        ]);
    });

    // ----------------------------------------------------------
    // CLIENTE (rol 2) — comprar, pagar, seguir pedido, reseñar
    // ----------------------------------------------------------
    Route::middleware('check.role:2')->group(function () {
        Route::apiResource('carritos', CarritoController::class);
        Route::apiResource('pedidos',  PedidoController::class)->only(['index', 'store', 'show']);
        Route::apiResource('pagos',    PagoController::class)->only(['store']);
        Route::apiResource('resenas',  ResenaController::class)->only(['index', 'store', 'show']);
    });

    // ----------------------------------------------------------
    // VENDEDOR (rol 3) — gestionar ventas, sin borrar nada
    // ----------------------------------------------------------
    Route::middleware('check.role:3')->group(function () {
        Route::apiResource('pedidos', PedidoController::class)->only(['index', 'show', 'update']);
        Route::apiResource('envios',  EnvioController::class)->only(['index', 'show', 'update', 'store']);
        Route::apiResource('pagos',   PagoController::class)->only(['index', 'show']);
        
        // El vendedor sí puede listar y ver detalles dentro del ecosistema protegido
        Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);
        Route::get('clientes', [UserController::class, 'clientes']);
    });

    // ----------------------------------------------------------
    // ADMIN (rol 1) — control total y absoluto
    // ----------------------------------------------------------
    Route::middleware('check.role:1')->group(function () {
        // Usuarios: CRUD completo
        Route::apiResource('usuarios', UserController::class);

        // Catálogo: ¡El admin puede hacer TODO, incluido index y show!
        Route::apiResource('productos',   ProductoController::class);
        Route::apiResource('categorias',  CategoriaController::class);
        Route::apiResource('marcas',      MarcaController::class);
        Route::apiResource('promociones', PromocionController::class);

        // Proveedores
        Route::apiResource('proveedores', ProveedorController::class);

        // Transacciones y logística
        Route::apiResource('pedidos', PedidoController::class);
        Route::apiResource('pagos',   PagoController::class);
        Route::apiResource('envios',  EnvioController::class);

        // Moderación de contenido
        Route::apiResource('resenas', ResenaController::class);
    });
});