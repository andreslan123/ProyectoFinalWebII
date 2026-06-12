<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PromocionController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;

// --- RUTAS PÚBLICAS ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Nota: Podrías dejar las categorías y marcas públicas para que el cliente vea el catálogo
Route::apiResource('categorias', CategoriaController::class)->only(['index', 'show']);
Route::apiResource('marcas', MarcaController::class)->only(['index', 'show']);

// --- RUTAS PROTEGIDAS (Requieren estar logueado) ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // El usuario puede gestionar su carrito y hacer pedidos
    Route::apiResource('carritos', CarritoController::class);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('resenas', ResenaController::class);
    
    // --- RUTAS DE ADMINISTRACIÓN (Solo Rol 1) ---
    // Aquí es donde deberías aplicar un middleware de rol si lo tienes
    Route::middleware('check.role:1')->group(function () {
        Route::apiResource('usuarios', UserController::class);
        Route::apiResource('proveedores', ProveedorController::class);
        Route::apiResource('productos', ProductoController::class); // El cliente no debe borrar productos
        Route::apiResource('promociones', PromocionController::class);
        Route::apiResource('pagos', PagoController::class);
        Route::apiResource('envios', EnvioController::class);
    });
});