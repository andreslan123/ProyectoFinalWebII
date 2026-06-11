<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    public function index(Request $request)
    {
        $envios = Envio::with(['pedido', 'estado'])
            ->whereHas('pedido', fn($q) => $q->where('user_id', $request->user()->id))
            ->get();

        return response()->json(['status' => true, 'data' => $envios]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'estado_id' => 'required|exists:estados_general,id',
            'metodo_envio' => 'required|string|max:50',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'empresa_envio' => 'nullable|string|max:150',
            'costo_envio' => 'required|numeric|min:0',
            'fecha_envio' => 'nullable|date',
            'fecha_entrega' => 'nullable|date|after_or_equal:fecha_envio',
        ]);

        $pedido = Pedido::find($request->pedido_id);
        if ($pedido->user_id != $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'No autorizado'], 403);
        }

        $envio = Envio::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Envío registrado correctamente',
            'data' => $envio
        ], 201);
    }

    public function show($id)
    {
        $envio = Envio::with(['pedido', 'estado'])->find($id);
        if (!$envio) return response()->json(['status' => false, 'message' => 'Envío no encontrado'], 404);

        return response()->json(['status' => true, 'data' => $envio]);
    }

    public function update(Request $request, $id)
    {
        $envio = Envio::find($id);
        if (!$envio) return response()->json(['status' => false, 'message' => 'Envío no encontrado'], 404);

        $request->validate([
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'metodo_envio' => 'sometimes|required|string|max:50',
            'codigo_seguimiento' => 'nullable|string|max:100',
            'empresa_envio' => 'nullable|string|max:150',
            'costo_envio' => 'sometimes|required|numeric|min:0',
            'fecha_envio' => 'nullable|date',
            'fecha_entrega' => 'nullable|date|after_or_equal:fecha_envio',
        ]);

        $envio->update($request->all());

        return response()->json(['status' => true, 'message' => 'Envío actualizado', 'data' => $envio]);
    }

    public function destroy($id)
    {
        $envio = Envio::find($id);
        if (!$envio) return response()->json(['status' => false, 'message' => 'Envío no encontrado'], 404);

        $envio->delete();
        return response()->json(['status' => true, 'message' => 'Envío eliminado correctamente']);
    }
}