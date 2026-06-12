<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    /**
     * INDEX
     * - Admin (rol 1): ve TODAS las reseñas, con filtros opcionales
     *   Filtros: ?producto_id=3  ?calificacion=5
     * - Cliente (rol 2): solo ve sus propias reseñas
     */
    public function index(Request $request)
    {
        $user  = $request->user();
        $query = Resena::with(['user', 'producto', 'estado']);

        if ($user->rol_id == 2) {
            // Cliente: solo sus reseñas
            $query->where('user_id', $user->id);
        } else {
            // Admin: puede filtrar por producto o calificación
            if ($request->filled('producto_id')) {
                $query->where('producto_id', $request->producto_id);
            }
            if ($request->filled('calificacion')) {
                $query->where('calificacion', $request->calificacion);
            }
        }

        return response()->json([
            'status' => true,
            'data'   => $query->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * STORE — Solo cliente (rol 2)
     * El cliente solo puede reseñar productos que haya comprado
     * (que existan en algún detalle de sus pedidos).
     * El estado_id se asigna automáticamente como "activo" (1),
     * el cliente no puede manipularlo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id'  => 'required|exists:productos,id',
            'calificacion' => 'required|integer|between:1,5',
            'comentario'   => 'nullable|string|max:500',
        ]);

        $user = $request->user();

        // Verificar que el cliente haya comprado el producto
        $haComprado = PedidoDetalle::whereHas('pedido', fn($q) => $q->where('user_id', $user->id))
                                   ->where('producto_id', $request->producto_id)
                                   ->exists();

        if (!$haComprado) {
            return response()->json([
                'status'  => false,
                'message' => 'Solo puedes reseñar productos que hayas comprado'
            ], 403);
        }

        // Verificar que no haya reseñado ya este producto
        $yaReseno = Resena::where('user_id', $user->id)
                          ->where('producto_id', $request->producto_id)
                          ->exists();

        if ($yaReseno) {
            return response()->json([
                'status'  => false,
                'message' => 'Ya dejaste una reseña para este producto'
            ], 409);
        }

        $resena = Resena::create([
            'user_id'      => $user->id,
            'producto_id'  => $request->producto_id,
            'estado_id'    => 1, // Activo — el sistema lo asigna, no el cliente
            'calificacion' => $request->calificacion,
            'comentario'   => $request->comentario,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Reseña registrada correctamente',
            'data'    => $resena->load(['user', 'producto'])
        ], 201);
    }

    /**
     * SHOW — Público implícito (cualquier logueado)
     * Todos pueden ver el detalle de una reseña.
     */
    public function show($id)
    {
        $resena = Resena::with(['user', 'producto', 'estado'])->find($id);

        if (!$resena) {
            return response()->json([
                'status'  => false,
                'message' => 'Reseña no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $resena
        ]);
    }

    /**
     * UPDATE
     * - Cliente (rol 2): solo puede editar sus propias reseñas (calificación y comentario)
     * - Admin (rol 1): puede cambiar el estado (ej. desactivar una reseña inapropiada)
     */
    public function update(Request $request, $id)
    {
        $user   = $request->user();
        $resena = Resena::find($id);

        if (!$resena) {
            return response()->json([
                'status'  => false,
                'message' => 'Reseña no encontrada'
            ], 404);
        }

        // Cliente no puede editar reseñas ajenas
        if ($user->rol_id == 2 && $resena->user_id !== $user->id) {
            return response()->json([
                'status'  => false,
                'message' => 'No tienes permiso para editar esta reseña'
            ], 403);
        }

        if ($user->rol_id == 2) {
            // Cliente solo puede cambiar calificación y comentario
            $request->validate([
                'calificacion' => 'sometimes|required|integer|between:1,5',
                'comentario'   => 'nullable|string|max:500',
            ]);

            $resena->update($request->only(['calificacion', 'comentario']));

        } else {
            // Admin puede cambiar el estado (moderar reseña)
            $request->validate([
                'estado_id'    => 'sometimes|required|exists:estados_general,id',
                'calificacion' => 'sometimes|required|integer|between:1,5',
                'comentario'   => 'nullable|string|max:500',
            ]);

            $resena->update($request->all());
        }

        return response()->json([
            'status'  => true,
            'message' => 'Reseña actualizada correctamente',
            'data'    => $resena->load(['user', 'producto', 'estado'])
        ]);
    }

    /**
     * DESTROY — Solo admin (rol 1)
     * El admin puede eliminar reseñas inapropiadas.
     */
    public function destroy($id)
    {
        $resena = Resena::find($id);

        if (!$resena) {
            return response()->json([
                'status'  => false,
                'message' => 'Reseña no encontrada'
            ], 404);
        }

        $resena->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Reseña eliminada correctamente'
        ]);
    }
}