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
        $carritos = Carrito::with(['detalles.producto'])
            ->where('user_id', $request->user()->id)
            ->get();

        $carritos->each(function ($carrito) {
            $total = 0;

            $carrito->detalles->each(function ($detalle) use (&$total) {
                $precio = $detalle->producto->precio_venta ?? 0;
                $subtotal = $precio * $detalle->cantidad;

                $detalle->precio_unitario = $precio;
                $detalle->subtotal = $subtotal;

                $total += $subtotal;
            });

            $carrito->total = $total;
        });

        return response()->json([
            'status' => true,
            'message' => 'Carrito obtenido correctamente',
            'data' => $carritos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ], [
            'producto_id.required' => 'El producto es obligatorio.',
            'producto_id.exists' => 'El producto seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
        ]);

        $producto = Producto::find($request->producto_id);

        if (!$producto) {
            return response()->json([
                'status' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        if ($producto->estado_id != 4) {
            return response()->json([
                'status' => false,
                'message' => 'El producto no está activo para la venta'
            ], 400);
        }

        $carrito = Carrito::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'estado_id' => 34
            ],
            [
                'created_at' => now()
            ]
        );

        $detalle = CarritoDetalle::where('carrito_id', $carrito->id)
            ->where('producto_id', $request->producto_id)
            ->first();

        if ($detalle) {
            $detalle->cantidad += $request->cantidad;
            $detalle->save();
        } else {
            $detalle = CarritoDetalle::create([
                'carrito_id' => $carrito->id,
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
            ]);
        }

        $detalle->load('producto');

        $precio = $detalle->producto->precio_venta ?? 0;
        $subtotal = $precio * $detalle->cantidad;

        $detalle->precio_unitario = $precio;
        $detalle->subtotal = $subtotal;

        return response()->json([
            'status' => true,
            'message' => 'Producto agregado al carrito correctamente',
            'data' => $detalle
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $carrito = Carrito::with(['detalles.producto'])
            ->where('user_id', $request->user()->id)
            ->find($id);

        if (!$carrito) {
            return response()->json([
                'status' => false,
                'message' => 'Carrito no encontrado'
            ], 404);
        }

        $total = 0;

        $carrito->detalles->each(function ($detalle) use (&$total) {
            $precio = $detalle->producto->precio_venta ?? 0;
            $subtotal = $precio * $detalle->cantidad;

            $detalle->precio_unitario = $precio;
            $detalle->subtotal = $subtotal;

            $total += $subtotal;
        });

        $carrito->total = $total;

        return response()->json([
            'status' => true,
            'message' => 'Carrito encontrado',
            'data' => $carrito
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ], [
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
        ]);

        $detalle = CarritoDetalle::with('carrito', 'producto')->find($id);

        if (!$detalle) {
            return response()->json([
                'status' => false,
                'message' => 'Detalle del carrito no encontrado'
            ], 404);
        }

        if ($detalle->carrito->user_id != $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'No autorizado para modificar este carrito'
            ], 403);
        }

        $detalle->update([
            'cantidad' => $request->cantidad,
        ]);

        $precio = $detalle->producto->precio_venta ?? 0;
        $subtotal = $precio * $detalle->cantidad;

        $detalle->precio_unitario = $precio;
        $detalle->subtotal = $subtotal;

        return response()->json([
            'status' => true,
            'message' => 'Cantidad actualizada correctamente',
            'data' => $detalle
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $detalle = CarritoDetalle::with('carrito')->find($id);

        if (!$detalle) {
            return response()->json([
                'status' => false,
                'message' => 'Detalle del carrito no encontrado'
            ], 404);
        }

        if ($detalle->carrito->user_id != $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'No autorizado para eliminar este producto del carrito'
            ], 403);
        }

        $detalle->delete();

        return response()->json([
            'status' => true,
            'message' => 'Producto eliminado del carrito correctamente'
        ]);
    }
}