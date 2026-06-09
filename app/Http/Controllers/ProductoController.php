<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    
    public function index()
    {
        // 1. Consultamos los productos con sus relaciones anidadas
        // Trae de un solo jalón la subcategoría, la marca y el stock actual
        $productos = Producto::with(['subcategoria', 'marca', 'stock'])->get();

        // 2. Retornamos la respuesta en formato JSON con un código de estado 200 (OK)
        return response()->json([
            'status' => 'success',
            'message' => 'Productos obtenidos correctamente',
            'data' => $productos
        ], 200);
    return response()->json($productos);

    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
