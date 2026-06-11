<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'rol_id' => 'nullable|exists:roles,id',
            'estado_id' => 'nullable|exists:estados_general,id',
            'name' => 'required|string|max:150',
            'apellido_paterno' => 'nullable|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci' => 'nullable|string|max:15|unique:users,ci',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'rol_id' => $request->rol_id ?? 2,
            'estado_id' => $request->estado_id ?? 1,
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci' => $request->ci,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('token-auth')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado correctamente',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user->load('rol', 'estado')
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::with('rol', 'estado')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas.'],
            ]);
        }

        if ($user->estado_id != 1) {
            return response()->json([
                'status' => false,
                'message' => 'El usuario no está activo'
            ], 403);
        }

        $token = $user->createToken('token-auth')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Inicio de sesión correcto',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sesión cerrada correctamente'
        ], 200);
    }
}