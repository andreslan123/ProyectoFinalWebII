<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => User::with('rol', 'estado')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id',
            'estado_id' => 'required|exists:estados_general,id',
            'name' => 'required|string|max:150',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci' => 'nullable|string|max:15|unique:users,ci',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'rol_id' => $request->rol_id,
            'estado_id' => $request->estado_id,
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci' => $request->ci,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $user->load('rol', 'estado')
        ], 201);
    }

    public function show($id)
    {
        $user = User::with('rol', 'estado')->find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $request->validate([
            'rol_id' => 'sometimes|required|exists:roles,id',
            'estado_id' => 'sometimes|required|exists:estados_general,id',
            'name' => 'sometimes|required|string|max:150',
            'apellido_paterno' => 'sometimes|required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci' => 'nullable|string|max:15|unique:users,ci,' . $id,
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->all();
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $user->load('rol', 'estado')
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }
}