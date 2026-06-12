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
// RUTAS PÚBLICAS (sin login)
// ============================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Catálogo visible para todos (clientes navegando sin cuenta)
Route::apiResource('categorias',  CategoriaController::class)->only(['index', 'show']);
Route::apiResource('marcas',      MarcaController::class)->only(['index', 'show']);
Route::apiResource('productos',   ProductoController::class)->only(['index', 'show']);
Route::apiResource('promociones', PromocionController::class)->only(['index', 'show']);

// ============================================================
// RUTAS PROTEGIDAS — requieren login (cualquier rol)
// ============================================================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

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
        // Pedidos: ver todos + actualizar estado (ej. confirmar)
        Route::apiResource('pedidos', PedidoController::class)->only(['index', 'show', 'update']);

        // Envíos: ver + actualizar estado (ej. en camino, entregado)
        Route::apiResource('envios', EnvioController::class)->only(['index', 'show', 'update', 'store']);

        // Pagos: solo ver (verificar que el cliente pagó)
        Route::apiResource('pagos', PagoController::class)->only(['index', 'show']);

        // Productos: solo ver (consultar stock, precio)
        Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);

        // Clientes: ver lista para atención al cliente
        Route::get('clientes', [UserController::class, 'clientes']);
    });

    // ----------------------------------------------------------
    // ADMIN (rol 1) — control total
    // ----------------------------------------------------------
    Route::middleware('check.role:1')->group(function () {
        // Usuarios: CRUD completo
        Route::apiResource('usuarios', UserController::class);

        // Catálogo: crear, editar, borrar
        Route::apiResource('productos',   ProductoController::class)->except(['index', 'show']);
        Route::apiResource('categorias',  CategoriaController::class)->except(['index', 'show']);
        Route::apiResource('marcas',      MarcaController::class)->except(['index', 'show']);
        Route::apiResource('promociones', PromocionController::class)->except(['index', 'show']);

        // Proveedores
        Route::apiResource('proveedores', ProveedorController::class);

        // Pedidos, pagos, envíos: control total
        Route::apiResource('pedidos', PedidoController::class);
        Route::apiResource('pagos',   PagoController::class);
        Route::apiResource('envios',  EnvioController::class);

        // Reseñas: el admin puede borrar reseñas inapropiadas
        Route::apiResource('resenas', ResenaController::class);
    });
});