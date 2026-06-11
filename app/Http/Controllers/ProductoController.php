<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Listar todos los productos con relaciones
    public function index()
    {
        $productos = Producto::with(['subcategoria', 'marca', 'stock'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Productos obtenidos correctamente',
            'data' => $productos
        ], 200);
    }

    // Crear producto
    public function store(Request $request)
{
    // 💡 Ajustamos la validación a las columnas REALES de tu phpMyAdmin
    $request->validate([
        'subcategoria_id' => 'required|integer',
        'marca_id'        => 'required|integer',
        'estado_id'       => 'required|integer',
        'codigo'          => 'required|string|unique:productos,codigo',
        'nombre'          => 'required|string|max:255',
        'descripcion'     => 'nullable|string',
        'precio_compra'   => 'required|numeric',
        'precio_venta'    => 'required|numeric',
    ]);

    // Guardamos usando el modelo
    $producto = \App\Models\Producto::create($request->all());

    return response()->json($producto, 201);
}

    // Mostrar producto específico
    public function show($id)
    {
        $producto = Producto::with(['subcategoria', 'marca', 'stock'])->find($id);

        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $producto
        ], 200);
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}