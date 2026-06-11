<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $pedidos = Pedido::with(['detalles.producto', 'pagos', 'envios'])->where('user_id', $request->user()->id)->get();
        return response()->json(['status' => true, 'data' => $pedidos]);
    }

    public function store(Request $request)
    {
        $carrito = Carrito::with('detalles')->where('user_id', $request->user()->id)->where('estado_id', 34)->first();
        if (!$carrito || $carrito->detalles->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Carrito vacío'], 400);
        }

        $total = $carrito->detalles->sum(function ($d) {
            return $d->cantidad * $d->producto->precio_venta;
        });

        $pedido = Pedido::create([
            'user_id' => $request->user()->id,
            'estado_id' => 9, // pendiente
            'codigo_pedido' => 'PED-' . date('Ymd') . '-' . Str::padLeft($request->user()->id, 4, '0'),
            'fecha_pedido' => now(),
            'total' => $total
        ]);

        foreach ($carrito->detalles as $d) {
            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $d->producto_id,
                'cantidad' => $d->cantidad
            ]);
        }

        // Cambiar carrito a procesado
        $carrito->update(['estado_id' => 35]);

        return response()->json([
            'status' => true,
            'message' => 'Pedido creado correctamente',
            'data' => $pedido
        ], 201);
    }

    public function show($id)
    {
        $pedido = Pedido::with(['detalles.producto', 'pagos', 'envios'])->find($id);
        if (!$pedido) {
            return response()->json(['status' => false, 'message' => 'Pedido no encontrado'], 404);
        }
        return response()->json(['status' => true, 'data' => $pedido]);
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        if (!$pedido) {
            return response()->json(['status' => false, 'message' => 'Pedido no encontrado'], 404);
        }

        $pedido->delete();
        return response()->json(['status' => true, 'message' => 'Pedido eliminado correctamente']);
    }
}