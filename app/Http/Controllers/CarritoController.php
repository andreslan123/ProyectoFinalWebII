<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index(Request $request)
    {
        $carritos = Carrito::with(['detalles.producto'])->where('user_id', $request->user()->id)->get();

        return response()->json([
            'status' => true,
            'data' => $carritos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener carrito del usuario o crear
        $carrito = Carrito::firstOrCreate([
            'user_id' => $request->user()->id,
            'estado_id' => 34 // activo
        ]);

        // Agregar detalle
        $detalle = CarritoDetalle::updateOrCreate(
            ['carrito_id' => $carrito->id, 'producto_id' => $request->producto_id],
            ['cantidad' => $request->cantidad]
        );

        return response()->json([
            'status' => true,
            'message' => 'Producto agregado al carrito',
            'data' => $detalle
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $detalle = CarritoDetalle::find($id);
        if (!$detalle) {
            return response()->json(['status' => false, 'message' => 'Detalle no encontrado'], 404);
        }

        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $detalle->update(['cantidad' => $request->cantidad]);

        return response()->json([
            'status' => true,
            'message' => 'Cantidad actualizada',
            'data' => $detalle
        ]);
    }

    public function destroy($id)
    {
        $detalle = CarritoDetalle::find($id);
        if (!$detalle) {
            return response()->json(['status' => false, 'message' => 'Detalle no encontrado'], 404);
        }

        $detalle->delete();

        return response()->json([
            'status' => true,
            'message' => 'Producto eliminado del carrito'
        ]);
    }
}