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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::apiResource('marcas', MarcaController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('usuarios', UserController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('proveedores', ProveedorController::class);
    Route::apiResource('promociones', PromocionController::class);
    Route::apiResource('carritos', CarritoController::class);
    Route::apiResource('pedidos', PedidoController::class);
    Route::apiResource('pagos', PagoController::class);
    Route::apiResource('envios', EnvioController::class);
    Route::apiResource('resenas', ResenaController::class);
});