<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Carrito;
use App\Models\StockProducto;
use App\Models\MovimientoStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * INDEX
     * - Admin (rol 1) y Vendedor (rol 3): ven TODOS los pedidos
     * - Cliente (rol 2): solo ve sus propios pedidos
     *
     * Filtros para admin/vendedor:
     *   ?estado_id=9     filtra por estado del pedido
     *   ?user_id=5       filtra por cliente específico
     */
    public function index(Request $request)
    {
        $user  = $request->user();
        $query = Pedido::with(['detalles.producto', 'pagos', 'envios', 'usuario']);

        if ($user->rol_id == 2) {
            // Cliente: solo sus pedidos
            $query->where('user_id', $user->id);
        } else {
            // Admin y vendedor: pueden filtrar por cliente o estado
            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }
            if ($request->filled('estado_id')) {
                $query->where('estado_id', $request->estado_id);
            }
        }

        return response()->json([
            'status' => true,
            'data'   => $query->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * STORE — Solo cliente (rol 2)
     * Convierte el carrito activo en un pedido.
     * Descuenta el stock de cada producto y registra el movimiento.
     * Todo dentro de una transacción para garantizar consistencia.
     */
    public function store(Request $request)
    {
        $carrito = Carrito::with('detalles.producto.stock')
                          ->where('user_id', $request->user()->id)
                          ->where('estado_id', 34) // activo
                          ->first();

        if (!$carrito || $carrito->detalles->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'No tienes un carrito activo o está vacío'
            ], 400);
        }

        // Verificar stock suficiente antes de crear el pedido
        foreach ($carrito->detalles as $detalle) {
            $stock = $detalle->producto->stock;

            if (!$stock || $stock->cantidad_actual < $detalle->cantidad) {
                return response()->json([
                    'status'  => false,
                    'message' => "Stock insuficiente para el producto: {$detalle->producto->nombre}. " .
                                 "Disponible: " . ($stock->cantidad_actual ?? 0) . ", solicitado: {$detalle->cantidad}"
                ], 400);
            }
        }

        // Transacción: todo o nada
        $pedido = DB::transaction(function () use ($carrito, $request) {

            $total = $carrito->detalles->sum(function ($detalle) {
                return $detalle->cantidad * ($detalle->producto->precio_venta ?? 0);
            });

            $pedido = Pedido::create([
                'user_id'      => $request->user()->id,
                'estado_id'    => 9, // pendiente
                'fecha_pedido' => now(),
                'total'        => $total
            ]);

            foreach ($carrito->detalles as $detalle) {
                // Crear detalle del pedido
                PedidoDetalle::create([
                    'pedido_id'   => $pedido->id,
                    'producto_id' => $detalle->producto_id,
                    'cantidad'    => $detalle->cantidad
                ]);

                // Descontar stock
                $stock = $detalle->producto->stock;
                $stock->decrement('cantidad_actual', $detalle->cantidad);

                // Registrar movimiento de stock
                MovimientoStock::create([
                    'producto_id'      => $detalle->producto_id,
                    'tipo_movimiento'  => 'salida',   // ← campo real en BD
                    'cantidad'         => $detalle->cantidad,
                    'motivo'           => "Venta - Pedido #{$pedido->id}",  // ← descripcion → motivo
                    'fecha_movimiento' => now(),
                ]);
            }

            // Marcar carrito como procesado
            $carrito->update(['estado_id' => 35]);

            return $pedido;
        });

        return response()->json([
            'status'  => true,
            'message' => 'Pedido creado correctamente',
            'data'    => $pedido->load(['detalles.producto', 'pagos', 'envios'])
        ], 201);
    }

    /**
     * SHOW
     * - Admin y vendedor: pueden ver cualquier pedido
     * - Cliente: solo puede ver sus propios pedidos
     */
    public function show(Request $request, $id)
    {
        $user   = $request->user();
        $pedido = Pedido::with(['detalles.producto', 'pagos', 'envios', 'usuario'])->find($id);

        if (!$pedido) {
            return response()->json([
                'status'  => false,
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        // Cliente no puede ver pedidos ajenos
        if ($user->rol_id == 2 && $pedido->user_id !== $user->id) {
            return response()->json([
                'status'  => false,
                'message' => 'No tienes permiso para ver este pedido'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data'   => $pedido
        ]);
    }

    /**
     * UPDATE — Admin (rol 1) y Vendedor (rol 3)
     * Actualiza el estado del pedido.
     * Ejemplos de estados: 9=pendiente, 10=confirmado, 11=en proceso, 12=enviado, 13=entregado
     */
    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'status'  => false,
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        $request->validate([
            'estado_id' => 'required|exists:estados_general,id',
        ]);

        $pedido->update([
            'estado_id' => $request->estado_id
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Estado del pedido actualizado correctamente',
            'data'    => $pedido->load(['detalles.producto', 'pagos', 'envios'])
        ]);
    }

    /**
     * DESTROY — Solo admin (rol 1)
     * Elimina un pedido. Solo el admin puede hacerlo.
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json([
                'status'  => false,
                'message' => 'Pedido no encontrado'
            ], 404);
        }

        $pedido->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Pedido eliminado correctamente'
        ]);
    }
}