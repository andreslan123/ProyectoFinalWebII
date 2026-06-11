<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Categoria::with('subcategorias')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique' => 'Esta categoría ya existe.',
        ]);

        $categoria = Categoria::create($request->only('nombre'));

        return response()->json([
            'status' => true,
            'message' => 'Categoría registrada correctamente',
            'data' => $categoria
        ], 201);
    }

    public function show($id)
    {
        $categoria = Categoria::with('subcategorias')->find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $categoria
        ]);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $id,
        ]);

        $categoria->update($request->only('nombre'));

        return response()->json([
            'status' => true,
            'message' => 'Categoría actualizada correctamente',
            'data' => $categoria
        ]);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json([
                'status' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }

        $categoria->delete();

        return response()->json([
            'status' => true,
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
}