<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    // 💡 GET /api/marcas (Listar todas las marcas)
    public function index()
    {
        return response()->json(Marca::all(), 200);
    }

    // 💡 POST /api/marcas (Crear una nueva marca)
    public function store(Request $request)
    {
        // Validamos que el nombre de la marca sea obligatorio y único
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre',
        ]);

        $marca = Marca::create($request->all());

        return response()->json($marca, 201); // 201 significa "Creado con éxito"
    }

    // 💡 GET /api/marcas/{id} (Ver una marca en específico)
    public function show(Marca $marca)
    {
        return response()->json($marca, 200);
    }

    // 💡 PUT/PATCH /api/marcas/{id} (Actualizar una marca)
    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marca->id,
        ]);

        $marca->update($request->all());

        return response()->json($marca, 200);
    }

    // 💡 DELETE /api/marcas/{id} (Eliminar una marca)
    public function destroy(Marca $marca)
    {
        $marca->delete();

        return response()->json(['message' => 'Marca eliminada con éxito'], 200);
    }
}