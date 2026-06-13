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

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('categorias', CategoriaController::class)
    ->only(['index', 'show']);

Route::apiResource('marcas', MarcaController::class)
    ->only(['index', 'show']);

Route::apiResource('productos', ProductoController::class)
    ->only(['index', 'show']);

Route::apiResource('promociones', PromocionController::class)
    ->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => true,
            'data' => $request->user()->load('rol', 'estado')
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | CLIENTE (ROL 2)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:2')->group(function () {

        Route::apiResource('carritos', CarritoController::class);

        Route::apiResource('pedidos', PedidoController::class)
            ->only(['index', 'store', 'show']);

        Route::apiResource('pagos', PagoController::class)
            ->only(['store']);

        Route::apiResource('resenas', ResenaController::class)
            ->only(['index', 'store', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | VENDEDOR (ROL 3)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:3')->group(function () {

        Route::apiResource('pedidos', PedidoController::class)
            ->only(['index', 'show', 'update']);

        Route::apiResource('envios', EnvioController::class)
            ->only(['index', 'show', 'update', 'store']);

        Route::apiResource('pagos', PagoController::class)
            ->only(['index', 'show']);

        Route::get('clientes', [UserController::class, 'clientes']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN (ROL 1)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:1')->group(function () {

        Route::apiResource('usuarios', UserController::class);

        // SOLO acciones administrativas
        Route::apiResource('productos', ProductoController::class)
            ->except(['index', 'show']);

        Route::apiResource('categorias', CategoriaController::class)
            ->except(['index', 'show']);

        Route::apiResource('marcas', MarcaController::class)
            ->except(['index', 'show']);

        Route::apiResource('promociones', PromocionController::class)
            ->except(['index', 'show']);

        Route::apiResource('proveedores', ProveedorController::class);

        Route::apiResource('pedidos', PedidoController::class);

        Route::apiResource('pagos', PagoController::class);

        Route::apiResource('envios', EnvioController::class);

        Route::apiResource('resenas', ResenaController::class);
    });
});