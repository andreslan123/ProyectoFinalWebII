<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * INDEX — Público
     * Devuelve todas las subcategorías con su categoría asociada.
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data'   => Subcategoria::with('categoria')->orderBy('nombre')->get()
        ], 200);
    }
}
