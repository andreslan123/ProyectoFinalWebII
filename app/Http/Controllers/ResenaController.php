<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function index(Request $request)
    {
        $resenas = Resena::with(['user', 'producto', 'estado'])
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json(['status' => true, 'data' => $resenas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'estado_id' => 'required|exists:estados_general,id',
            'calificacion' => 'required|integer|between:1,5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $resena = Resena::create([
            'user_id' => $request->user()->id,
            'producto_id' => $request->producto_id,
            'estado_id' => $request->estado_id,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reseña registrada correctamente',
            'data' => $resena
        ], 201);
    }

    public function show($id)
    {
        $resena = Resena::with(['user', 'producto', 'estado'])->find($id);
        if (!$resena) return response()->json(['status' => false, 'message' => 'Reseña no encontrada'], 404);

        return response()->json(['status' => true, 'data' => $resena]);
    }

    public function update(Request $request, $id)
    {
        $resena = Resena::find($id);
        if (!$resena) return response()->json(['status' => false, 'message' => 'Reseña no encontrada'], 404);

        $request->validate([
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'calificacion' => 'sometimes|required|integer|between:1,5',
            'comentario' => 'nullable|string|max:500',
        ]);

        $resena->update($request->all());

        return response()->json(['status' => true, 'message' => 'Reseña actualizada', 'data' => $resena]);
    }

    public function destroy($id)
    {
        $resena = Resena::find($id);
        if (!$resena) return response()->json(['status' => false, 'message' => 'Reseña no encontrada'], 404);

        $resena->delete();
        return response()->json(['status' => true, 'message' => 'Reseña eliminada correctamente']);
    }
}