<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * REGISTER — Público
     * El registro siempre crea un cliente (rol_id = 3, estado_id = 1).
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:150',
            'apellido_paterno' => 'nullable|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci'               => 'nullable|string|max:15|unique:users,ci',
            'email'            => 'required|email|max:191|unique:users,email',
            'password'         => 'required|string|min:6',
        ]);

        $user = User::create([
            'rol_id'           => 2, // CORREGIDO: 3 es Cliente globalmente ahora
            'estado_id'        => 1, // Siempre activo
            'name'             => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci'               => $request->ci,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
        ]);

        $token = $user->createToken('token-auth')->plainTextToken;

        return response()->json([
            'status'      => true,
            'message'     => 'Usuario registrado correctamente',
            'token'       => $token,
            'token_type'  => 'Bearer',
            'user'        => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'rol_id'   => 3
            ]
        ], 201);
    }

    /**
     * LOGIN — Público
     * Valida credenciales con respuestas limpias en formato JSON estándar.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::with('rol', 'estado')
                    ->where('email', $request->email)
                    ->first();

        // CORREGIDO: Retorna un JSON 401 estructurado si las credenciales fallan
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Credenciales incorrectas. Verifica tu correo o contraseña.'
            ], 401);
        }

        // Usuario inactivo o baneado
        if ($user->estado_id != 1) {
            return response()->json([
                'status'  => false,
                'message' => 'Tu cuenta está inactiva. Contacta al administrador.'
            ], 403);
        }

        // CORREGIDO: Mapeo de rutas simétrico con las carpetas de tu frontend
        $redirectTo = match((int) $user->rol_id) {
            1 => '/pages/admin/dashboard.html',
            2 => '/pages/vendedor/vendedor-dashboard.html',
            3 => '/index.html',
            default => '/index.html',
        };

        $token = $user->createToken('token-auth')->plainTextToken;

        return response()->json([
            'status'      => true,
            'message'     => '¡Bienvenido, ' . $user->name . '!',
            'token'       => $token,
            'token_type'  => 'Bearer',
            'redirect_to' => $redirectTo,
            'user'        => [
                'id'               => $user->id,
                'name'             => $user->name,
                'apellido_paterno' => $user->apellido_paterno,
                'email'            => $user->email,
                'rol_id'           => (int) $user->rol_id, // Forzamos entero para JS
                'rol_nombre'       => $user->rol->nombre ?? 'Sin rol',
            ]
        ], 200);
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Sesión cerrada correctamente'
        ], 200);
    }
}