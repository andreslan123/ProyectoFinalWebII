<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\ProductoImagen;

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
        $query = Producto::with(['subcategoria', 'marca', 'stock', 'imagenes']);

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
            'data'    => $query->paginate(20)
        ], 200);
    }

    /**
     * STORE — Solo admin
     * Crea un producto nuevo. Valida que las FK existan en sus tablas.
     * El request debe enviarse como multipart/form-data si se suben imágenes.
     * Campo de imágenes: imagenes[] (array de archivos)
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
            'imagenes'        => 'nullable|array',
            'imagenes.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $producto = Producto::create($request->except('imagenes'));

        // Guardar imágenes si se enviaron
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $archivo) {
                $ruta = $archivo->store('productos', 'public');

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen'      => $ruta,
                    'estado_id'   => 1,
                ]);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Producto creado correctamente',
            'data'    => $producto->load(['subcategoria', 'marca', 'stock', 'imagenes'])
        ], 201);
    }

    /**
     * SHOW — Público
     * Devuelve el detalle de un producto con todas sus relaciones.
     */
    public function show($id)
    {
        $producto = Producto::with(['subcategoria', 'marca', 'stock', 'imagenes'])->find($id);

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
     * Si se envían imágenes nuevas, se agregan sin borrar las existentes.
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
            'imagenes'        => 'nullable|array',
            'imagenes.*'      => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $producto->update($request->except('imagenes'));

        // Agregar nuevas imágenes si se enviaron
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $archivo) {
                $ruta = $archivo->store('productos', 'public');

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'imagen'      => $ruta,
                    'estado_id'   => 1,
                ]);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Producto actualizado correctamente',
            'data'    => $producto->load(['subcategoria', 'marca', 'stock', 'imagenes'])
        ], 200);
    }

    /**
     * DESTROY — Solo admin
     * Elimina un producto y sus imágenes del storage.
     * Si tiene pedidos asociados MySQL lo bloqueará
     * por integridad referencial — considera usar estado_id para desactivarlo en su lugar.
     */
    public function destroy($id)
    {
        $producto = Producto::with('imagenes')->find($id);

        if (!$producto) {
            return response()->json([
                'status'  => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        // Eliminar archivos físicos del storage
        foreach ($producto->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->imagen);
        }

        $producto->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }

    /**
     * ELIMINAR IMAGEN — Solo admin
     * DELETE /api/productos/{id}/imagenes/{imagen_id}
     * Elimina una imagen específica de un producto.
     */
    public function destroyImagen($id, $imagen_id)
    {
        $imagen = ProductoImagen::where('producto_id', $id)
                                ->where('id', $imagen_id)
                                ->first();

        if (!$imagen) {
            return response()->json([
                'status'  => false,
                'message' => 'Imagen no encontrada'
            ], 404);
        }

        Storage::disk('public')->delete($imagen->imagen);
        $imagen->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Imagen eliminada correctamente'
        ], 200);
    }
}