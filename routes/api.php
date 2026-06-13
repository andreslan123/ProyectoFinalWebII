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

// ============================================================
// RUTAS PÚBLICAS (sin login — Catálogo para visitantes)
// ============================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Catálogo visible para todos (clientes navegando de forma anónima)
Route::get('/subcategorias', [SubcategoriaController::class, 'index']);


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
    // PEDIDOS (rol 1 admin, 2 cliente, 3 vendedor)
    // GET /pedidos y GET /pedidos/{id} son compartidos por los 3 roles.
    // El controller (PedidoController@index) filtra internamente:
    //   - cliente ve solo los suyos; admin/vendedor ven todos.
    // Registrarlos en un único grupo evita que Laravel "atrape" la
    // petición con el middleware del primer rol registrado y bloquee
    // a los demás roles con un 403 (bug original).
    // ----------------------------------------------------------
    Route::middleware('check.role:1,2,3')->group(function () {
        Route::apiResource('pedidos', PedidoController::class)->only(['index', 'show']);
    });

    // PUT/PATCH /pedidos/{id} — admin y vendedor pueden actualizar estado
    Route::middleware('check.role:1,3')->group(function () {
        Route::apiResource('pedidos', PedidoController::class)->only(['update']);
    });

    // POST y PUT/PATCH /productos — admin y vendedor pueden crear/editar
    Route::middleware('check.role:1,3')->group(function () {
        Route::apiResource('productos', ProductoController::class)->only(['store', 'update']);
    });

    // ----------------------------------------------------------
    // CLIENTE (rol 2) — comprar, pagar, seguir pedido, reseñar
    // ----------------------------------------------------------
    Route::middleware('check.role:2')->group(function () {
        Route::apiResource('carritos', CarritoController::class);
        Route::apiResource('pedidos',  PedidoController::class)->only(['store']);
        Route::apiResource('pagos',    PagoController::class)->only(['store']);
        Route::apiResource('resenas',  ResenaController::class)->only(['index', 'store', 'show']);
    });

    // ----------------------------------------------------------
    // VENDEDOR (rol 3) — gestionar ventas, sin borrar nada
    // ----------------------------------------------------------
    Route::middleware('check.role:3')->group(function () {
        Route::apiResource('envios',  EnvioController::class)->only(['index', 'show', 'update', 'store']);
        Route::apiResource('pagos',   PagoController::class)->only(['index', 'show']);
        
        // El vendedor sí puede listar y ver detalles dentro del ecosistema protegido
        Route::get('clientes', [UserController::class, 'clientes']);
    });

    // ----------------------------------------------------------
    // ADMIN (rol 1) — control total y absoluto
    // ----------------------------------------------------------
    Route::middleware('check.role:1')->group(function () {
        // Usuarios: CRUD completo
        Route::apiResource('usuarios', UserController::class);

        // Catálogo: ¡El admin puede hacer TODO! (index/show son públicos, ver abajo)
        Route::apiResource('productos',   ProductoController::class)->only(['destroy']);
        Route::apiResource('categorias',  CategoriaController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('marcas',      MarcaController::class)->only(['store', 'update', 'destroy']);
        Route::apiResource('promociones', PromocionController::class)->only(['store', 'update', 'destroy']);

        // Proveedores
        Route::apiResource('proveedores', ProveedorController::class);

        // Transacciones y logística
        Route::apiResource('pedidos', PedidoController::class)->only(['store', 'destroy']);
        Route::apiResource('pagos',   PagoController::class);
        Route::apiResource('envios',  EnvioController::class);

        // Moderación de contenido
        Route::apiResource('resenas', ResenaController::class);
    });
});

// ============================================================
// PRODUCTOS — index/show públicos (catálogo)
// IMPORTANTE: van AL FINAL del archivo. En Laravel, cuando dos rutas
// comparten la misma URI+método, la ÚLTIMA registrada es la que se
// usa (sobrescribe a las anteriores). Si esta ruta no va al final,
// el resource del admin (CheckRole:1) la sobrescribe y bloquea a
// vendedor, cliente y visitantes anónimos.
// ============================================================
Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);
Route::apiResource('categorias',  CategoriaController::class)->only(['index', 'show']);
Route::apiResource('marcas',      MarcaController::class)->only(['index', 'show']);
Route::apiResource('promociones', PromocionController::class)->only(['index', 'show']);