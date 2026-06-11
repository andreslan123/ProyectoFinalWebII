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

Route::get('/test', function () {
    return response()->json([
        'mensaje' => 'API funcionando correctamente'
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('usuarios', UserController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('promociones', PromocionController::class);
Route::apiResource('carritos', CarritoController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('pagos', PagoController::class);
Route::apiResource('envios', EnvioController::class);
Route::apiResource('resenas', ResenaController::class);