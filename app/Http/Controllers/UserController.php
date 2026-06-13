<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * INDEX — Solo admin
     * Lista TODOS los usuarios (clientes, vendedores, admins) con filtros opcionales.
     * Filtros: ?buscar=garcia  busca por apellido_paterno o CI
     */
    public function index(Request $request)
    {
        $query = User::with('rol', 'estado');

        if ($request->filled('buscar')) {
            $termino = $request->buscar;
            $query->where(function ($q) use ($termino) {
                $q->where('apellido_paterno', 'like', '%' . $termino . '%')
                  ->orWhere('apellido_materno', 'like', '%' . $termino . '%')
                  ->orWhere('ci', 'like', '%' . $termino . '%')
                  ->orWhere('name', 'like', '%' . $termino . '%');
            });
        }

        // Filtro opcional por rol: ?rol_id=2 para ver solo clientes
        if ($request->filled('rol_id')) {
            $query->where('rol_id', $request->rol_id);
        }

        return response()->json([
            'status' => true,
            'data'   => $query->get()
        ]);
    }

    /**
     * CLIENTES — Solo vendedor
     * Lista únicamente usuarios con rol_id = 2 (clientes).
     * El vendedor puede buscar por apellido o CI para atención al cliente.
     * Ejemplo: GET /api/clientes?buscar=quispe
     */
    public function clientes(Request $request)
    {
        $query = User::with('estado')->where('rol_id', 2);

        if ($request->filled('buscar')) {
            $termino = $request->buscar;
            $query->where(function ($q) use ($termino) {
                $q->where('apellido_paterno', 'like', '%' . $termino . '%')
                  ->orWhere('apellido_materno', 'like', '%' . $termino . '%')
                  ->orWhere('ci', 'like', '%' . $termino . '%')
                  ->orWhere('name', 'like', '%' . $termino . '%');
            });
        }

        return response()->json([
            'status'   => true,
            'message'  => 'Lista de clientes',
            'data'     => $query->get()
        ]);
    }

    /**
     * STORE — Solo admin
     * Crea un usuario con cualquier rol (admin puede crear vendedores u otros admins).
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol_id'           => 'required|exists:roles,id',
            'estado_id'        => 'required|exists:estados_general,id',
            'name'             => 'required|string|max:150',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci'               => 'nullable|string|max:15|unique:users,ci',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:6',
        ]);

        $user = User::create([
            'rol_id'           => $request->rol_id,
            'estado_id'        => $request->estado_id,
            'name'             => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci'               => $request->ci,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Usuario registrado correctamente',
            'data'    => $user->load('rol', 'estado')
        ], 201);
    }

    /**
     * SHOW — Solo admin
     * Muestra el detalle de un usuario por ID.
     */
    public function show($id)
    {
        $user = User::with('rol', 'estado')->find($id);

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $user
        ]);
    }

    /**
     * UPDATE — Solo admin
     * Edita datos de un usuario. 'sometimes' = solo valida el campo si viene en el request.
     * La regla unique ignora el propio ID del usuario editado para no marcar falso conflicto.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $request->validate([
            'rol_id'           => 'sometimes|required|exists:roles,id',
            'estado_id'        => 'sometimes|required|exists:estados_general,id',
            'name'             => 'sometimes|required|string|max:150',
            'apellido_paterno' => 'sometimes|required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci'               => 'nullable|string|max:15|unique:users,ci,' . $id,
            'email'            => 'sometimes|required|email|unique:users,email,' . $id,
            'password'         => 'nullable|string|min:6',
        ]);

        $data = $request->all();

        // Solo re-encripta si mandaron una contraseña nueva y no está vacía
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Usuario actualizado correctamente',
            'data'    => $user->load('rol', 'estado')
        ]);
    }

    /**
     * DESTROY — Solo admin
     * Elimina un usuario. Si tiene pedidos asociados MySQL lo bloqueará
     * por integridad referencial — en ese caso conviene usar estado_id = 2 (inactivo) en lugar de borrar.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status'  => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }
}