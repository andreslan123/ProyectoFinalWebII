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
use App\Http\Controllers\SubcategoriaController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Catálogo abierto)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/subcategorias', [SubcategoriaController::class, 'index']);

Route::apiResource('categorias', CategoriaController::class)->only(['index', 'show']);
Route::apiResource('marcas', MarcaController::class)->only(['index', 'show']);
Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);
Route::apiResource('promociones', PromocionController::class)->only(['index', 'show']);

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (Sanctum)
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

    // ----------------------------------------------------------
    // RUTAS COMPARTIDAS
    // ----------------------------------------------------------
    
    // Admin (1), Cliente (2) y Vendedor (3) pueden ver pedidos (el controlador filtra qué ve cada uno)
    Route::middleware('check.role:1,2,3')->group(function () {
        Route::apiResource('pedidos', PedidoController::class)->only(['index', 'show']);
    });

    // Admin (1) y Vendedor (3) pueden crear/editar productos y actualizar estados de pedidos
    Route::middleware('check.role:1,3')->group(function () {
        Route::apiResource('productos', ProductoController::class)->only(['store', 'update']);
        Route::apiResource('pedidos', PedidoController::class)->only(['update']);
    });

    /*
    |--------------------------------------------------------------------------
    | CLIENTE (ROL 2)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:2')->group(function () {
        Route::apiResource('carritos', CarritoController::class);
        Route::apiResource('pedidos', PedidoController::class)->only(['store']);
        Route::apiResource('pagos', PagoController::class)->only(['store']);
        Route::apiResource('resenas', ResenaController::class)->only(['index', 'store', 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | VENDEDOR (ROL 3)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:3')->group(function () {
        Route::apiResource('envios', EnvioController::class)->only(['index', 'show', 'update', 'store']);
        Route::apiResource('pagos', PagoController::class)->only(['index', 'show']);
        Route::get('clientes', [UserController::class, 'clientes']);
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN (ROL 1)
    |--------------------------------------------------------------------------
    */
    Route::middleware('check.role:1')->group(function () {
        Route::apiResource('usuarios', UserController::class);
        Route::apiResource('proveedores', ProveedorController::class);

        // El admin puede eliminar productos, y gestionar por completo categorías, marcas y promociones
        Route::apiResource('productos', ProductoController::class)->only(['destroy']);
        Route::apiResource('categorias', CategoriaController::class)->except(['index', 'show']);
        Route::apiResource('marcas', MarcaController::class)->except(['index', 'show']);
        Route::apiResource('promociones', PromocionController::class)->except(['index', 'show']);

        // Gestión de pedidos, pagos, envíos y reseñas (lo que no hacen los otros roles)
        Route::apiResource('pedidos', PedidoController::class)->only(['store', 'destroy']);
        Route::apiResource('pagos', PagoController::class)->except(['store']); 
        Route::apiResource('envios', EnvioController::class)->except(['index', 'show', 'update', 'store']);
        Route::apiResource('resenas', ResenaController::class)->except(['index', 'show', 'store']);
    });
});