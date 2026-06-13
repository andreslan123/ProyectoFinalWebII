<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    /**
     * INDEX
     * - Admin (rol 1) y Vendedor (rol 3): ven TODOS los envíos
     *   Filtros: ?estado_id=12  ?pedido_id=5
     * - Cliente (rol 2): solo ve los envíos de sus propios pedidos
     */
    public function index(Request $request)
    {
        $user  = $request->user();
        $query = Envio::with(['pedido.usuario', 'estado']);

        if ($user->rol_id == 2) {
            // Cliente: solo sus envíos via pedidos propios
            $query->whereHas('pedido', fn($q) => $q->where('user_id', $user->id));
        } else {
            // Admin y vendedor: filtros opcionales
            if ($request->filled('estado_id')) {
                $query->where('estado_id', $request->estado_id);
            }
            if ($request->filled('pedido_id')) {
                $query->where('pedido_id', $request->pedido_id);
            }
        }

        return response()->json([
            'status' => true,
            'data'   => $query->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * STORE — Admin (rol 1) y Vendedor (rol 3)
     * Registra un envío para un pedido existente.
     * No verifica user_id porque el vendedor/admin crea envíos para pedidos de clientes.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pedido_id'          => 'required|exists:pedidos,id',
            'estado_id'          => 'required|exists:estados_general,id',
            'metodo_envio'       => 'required|string|max:50',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'empresa_envio'      => 'nullable|string|max:150',
            'costo_envio'        => 'required|numeric|min:0',
            'fecha_envio'        => 'nullable|date',
            'fecha_entrega'      => 'nullable|date|after_or_equal:fecha_envio',
        ]);

        $envio = Envio::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Envío registrado correctamente',
            'data'    => $envio->load(['pedido.usuario', 'estado'])
        ], 201);
    }

    /**
     * SHOW
     * - Admin y vendedor: pueden ver cualquier envío
     * - Cliente: solo puede ver envíos de sus propios pedidos
     */
    public function show(Request $request, $id)
    {
        $user  = $request->user();
        $envio = Envio::with(['pedido.usuario', 'estado'])->find($id);

        if (!$envio) {
            return response()->json([
                'status'  => false,
                'message' => 'Envío no encontrado'
            ], 404);
        }

        // Cliente no puede ver envíos de pedidos ajenos
        if ($user->rol_id == 2 && $envio->pedido->user_id !== $user->id) {
            return response()->json([
                'status'  => false,
                'message' => 'No tienes permiso para ver este envío'
            ], 403);
        }

        return response()->json([
            'status' => true,
            'data'   => $envio
        ]);
    }

    /**
     * UPDATE — Admin (rol 1) y Vendedor (rol 3)
     * Actualiza el estado del envío o datos de seguimiento.
     * Casos de uso: marcar como "en camino", agregar código de seguimiento, registrar fecha de entrega.
     */
    public function update(Request $request, $id)
    {
        $envio = Envio::find($id);

        if (!$envio) {
            return response()->json([
                'status'  => false,
                'message' => 'Envío no encontrado'
            ], 404);
        }

        $request->validate([
            'estado_id'          => 'sometimes|required|exists:estados_general,id',
            'metodo_envio'       => 'sometimes|required|string|max:50',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'empresa_envio'      => 'nullable|string|max:150',
            'costo_envio'        => 'sometimes|required|numeric|min:0',
            'fecha_envio'        => 'nullable|date',
            'fecha_entrega'      => 'nullable|date|after_or_equal:fecha_envio',
        ]);

        $envio->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Envío actualizado correctamente',
            'data'    => $envio->load(['pedido.usuario', 'estado'])
        ]);
    }

    /**
     * DESTROY — Solo admin (rol 1)
     * El vendedor no puede eliminar envíos, solo actualizarlos.
     */
    public function destroy(Request $request, $id)
    {
        $envio = Envio::find($id);

        if (!$envio) {
            return response()->json([
                'status'  => false,
                'message' => 'Envío no encontrado'
            ], 404);
        }

        $envio->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Envío eliminado correctamente'
        ]);
    }
}