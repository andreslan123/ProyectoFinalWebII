<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Proveedor::with(['estado', 'telefonos.tipoTelefono', 'productos'])->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados_general,id',
            'nombre_empresa' => 'required|string|max:200',
            'nit' => 'nullable|string|max:50|unique:proveedores,nit',
            'correo' => 'nullable|email|max:191|unique:proveedores,correo',
            'direccion' => 'nullable|string|max:300',
        ], [
            'estado_id.required' => 'El estado del proveedor es obligatorio.',
            'estado_id.exists' => 'El estado seleccionado no existe.',
            'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'nit.unique' => 'Este NIT ya está registrado.',
            'correo.email' => 'El correo no tiene un formato válido.',
        ]);

        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Proveedor registrado correctamente',
            'data' => $proveedor
        ], 201);
    }

    public function show($id)
    {
        $proveedor = Proveedor::with(['estado', 'telefonos.tipoTelefono', 'productos'])->find($id);

        if (!$proveedor) {
            return response()->json([
                'status' => false,
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $proveedor
        ]);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json([
                'status' => false,
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        $request->validate([
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'nombre_empresa' => 'sometimes|required|string|max:200',
            'nit' => 'nullable|string|max:50|unique:proveedores,nit,' . $id,
            'correo' => 'nullable|email|max:191|unique:proveedores,correo,' . $id,
            'direccion' => 'nullable|string|max:300',
        ]);

        $proveedor->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Proveedor actualizado correctamente',
            'data' => $proveedor
        ]);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return response()->json([
                'status' => false,
                'message' => 'Proveedor no encontrado'
            ], 404);
        }

        $proveedor->delete();

        return response()->json([
            'status' => true,
            'message' => 'Proveedor eliminado correctamente'
        ]);
    }
}