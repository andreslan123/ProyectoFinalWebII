<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Al ponerlo en este archivo, Laravel le añade automáticamente el prefijo "/api" a la URL
Route::apiResource('productos', ProductoController::class);
