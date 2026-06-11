<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        $pagos = Pago::with(['pedido', 'estado'])
            ->whereHas('pedido', fn($q) => $q->where('user_id', $request->user()->id))
            ->get();

        return response()->json(['status' => true, 'data' => $pagos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'estado_id' => 'required|exists:estados_general,id',
            'metodo_pago' => 'required|string|max:50',
            'monto' => 'required|numeric|min:0',
        ]);

        $pedido = Pedido::find($request->pedido_id);
        if ($pedido->user_id != $request->user()->id) {
            return response()->json(['status' => false, 'message' => 'No autorizado'], 403);
        }

        $pago = Pago::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pago registrado correctamente',
            'data' => $pago
        ], 201);
    }

    public function show($id)
    {
        $pago = Pago::with(['pedido', 'estado'])->find($id);
        if (!$pago) return response()->json(['status' => false, 'message' => 'Pago no encontrado'], 404);

        return response()->json(['status' => true, 'data' => $pago]);
    }

    public function update(Request $request, $id)
    {
        $pago = Pago::find($id);
        if (!$pago) return response()->json(['status' => false, 'message' => 'Pago no encontrado'], 404);

        $request->validate([
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'metodo_pago' => 'sometimes|required|string|max:50',
            'monto' => 'sometimes|required|numeric|min:0',
        ]);

        $pago->update($request->all());

        return response()->json(['status' => true, 'message' => 'Pago actualizado', 'data' => $pago]);
    }

    public function destroy($id)
    {
        $pago = Pago::find($id);
        if (!$pago) return response()->json(['status' => false, 'message' => 'Pago no encontrado'], 404);

        $pago->delete();
        return response()->json(['status' => true, 'message' => 'Pago eliminado correctamente']);
    }
}