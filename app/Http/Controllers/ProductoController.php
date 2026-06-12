<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * INDEX — Público (también usado por admin y vendedor)
     * Devuelve todos los productos activos con sus relaciones.
     *
     * Filtros opcionales via query string:
     *   ?buscar=freno        busca por nombre o descripción
     *   ?marca_id=2          filtra por marca
     *   ?subcategoria_id=5   filtra por subcategoría
     *   ?precio_min=50       precio mínimo
     *   ?precio_max=500      precio máximo
     */
    public function index(Request $request)
    {
        $query = Producto::with(['subcategoria', 'marca', 'stock']);

        // Búsqueda por nombre o descripción
        if ($request->filled('buscar')) {
            $termino = $request->buscar;
            $query->where(function ($q) use ($termino) {
                $q->where('nombre', 'like', '%' . $termino . '%')
                  ->orWhere('descripcion', 'like', '%' . $termino . '%')
                  ->orWhere('codigo', 'like', '%' . $termino . '%');
            });
        }

        // Filtro por marca
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }

        // Filtro por subcategoría
        if ($request->filled('subcategoria_id')) {
            $query->where('subcategoria_id', $request->subcategoria_id);
        }

        // Filtro por rango de precio
        if ($request->filled('precio_min')) {
            $query->where('precio_venta', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_venta', '<=', $request->precio_max);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Productos obtenidos correctamente',
            'data'    => $query->get()
        ], 200);
    }

    /**
     * STORE — Solo admin
     * Crea un producto nuevo. Valida que las FK existan en sus tablas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'marca_id'        => 'required|exists:marcas,id',
            'estado_id'       => 'required|exists:estados_general,id',
            'codigo'          => 'required|string|unique:productos,codigo',
            'nombre'          => 'required|string|max:255',
            'descripcion'     => 'nullable|string',
            'precio_compra'   => 'required|numeric|min:0',
            'precio_venta'    => 'required|numeric|min:0',
        ]);

        $producto = Producto::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Producto creado correctamente',
            'data'    => $producto->load(['subcategoria', 'marca', 'stock'])
        ], 201);
    }

    /**
     * SHOW — Público
     * Devuelve el detalle de un producto con todas sus relaciones.
     */
    public function show($id)
    {
        $producto = Producto::with(['subcategoria', 'marca', 'stock'])->find($id);

        if (!$producto) {
            return response()->json([
                'status'  => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $producto
        ], 200);
    }

    /**
     * UPDATE — Solo admin
     * Edición parcial con 'sometimes': solo valida los campos que lleguen en el request.
     * La regla unique ignora el propio producto para no marcar conflicto al editar el mismo código.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'status'  => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $request->validate([
            'subcategoria_id' => 'sometimes|required|exists:subcategorias,id',
            'marca_id'        => 'sometimes|required|exists:marcas,id',
            'estado_id'       => 'sometimes|required|exists:estados_general,id',
            'codigo'          => 'sometimes|required|string|unique:productos,codigo,' . $id,
            'nombre'          => 'sometimes|required|string|max:255',
            'descripcion'     => 'nullable|string',
            'precio_compra'   => 'sometimes|required|numeric|min:0',
            'precio_venta'    => 'sometimes|required|numeric|min:0',
        ]);

        $producto->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Producto actualizado correctamente',
            'data'    => $producto->load(['subcategoria', 'marca', 'stock'])
        ], 200);
    }

    /**
     * DESTROY — Solo admin
     * Elimina un producto. Si tiene pedidos asociados MySQL lo bloqueará
     * por integridad referencial — considera usar estado_id para desactivarlo en su lugar.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'status'  => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $producto->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}