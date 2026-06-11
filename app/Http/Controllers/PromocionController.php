<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Promocion::with(['estado', 'productos'])->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados_general,id',
            'tipo_descuento' => 'required|string|max:20|in:porcentaje,monto_fijo',
            'titulo' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'valor_descuento' => 'required|numeric|min:0',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $promocion = Promocion::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Promoción registrada correctamente',
            'data' => $promocion
        ], 201);
    }

    public function show($id)
    {
        $promocion = Promocion::with(['estado', 'productos'])->find($id);

        if (!$promocion) {
            return response()->json([
                'status' => false,
                'message' => 'Promoción no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $promocion
        ]);
    }

    public function update(Request $request, $id)
    {
        $promocion = Promocion::find($id);

        if (!$promocion) {
            return response()->json([
                'status' => false,
                'message' => 'Promoción no encontrada'
            ], 404);
        }

        $request->validate([
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'tipo_descuento' => 'sometimes|required|string|max:20|in:porcentaje,monto_fijo',
            'titulo' => 'sometimes|required|string|max:200',
            'descripcion' => 'nullable|string',
            'valor_descuento' => 'sometimes|required|numeric|min:0',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'sometimes|required|date|after_or_equal:fecha_inicio',
        ]);

        $promocion->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Promoción actualizada correctamente',
            'data' => $promocion
        ]);
    }

    public function destroy($id)
    {
        $promocion = Promocion::find($id);

        if (!$promocion) {
            return response()->json([
                'status' => false,
                'message' => 'Promoción no encontrada'
            ], 404);
        }

        $promocion->delete();

        return response()->json([
            'status' => true,
            'message' => 'Promoción eliminada correctamente'
        ]);
    }
}