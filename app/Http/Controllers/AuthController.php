<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * REGISTER — Público
     * El registro siempre crea un cliente (rol_id = 2, estado_id = 1).
     * No se acepta rol_id ni estado_id del request — seguridad básica para que
     * nadie se registre como admin mandando rol_id=1 en el body.
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
            'rol_id'           => 2, // Siempre cliente — no viene del request
            'estado_id'        => 1, // Siempre activo — no viene del request
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
            'redirect_to' => '/tienda/catalogo',
            'user'        => $user->load('rol', 'estado')
        ], 201);
    }

    /**
     * LOGIN — Público
     * Valida credenciales, verifica que el usuario esté activo,
     * y devuelve el token + ruta de redirección según el rol.
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

        // Credenciales incorrectas
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas.'],
            ]);
        }

        // Usuario inactivo o baneado
        if ($user->estado_id != 1) {
            return response()->json([
                'status'  => false,
                'message' => 'Tu cuenta está inactiva. Contacta al administrador.'
            ], 403);
        }

        // Ruta de redirección según rol
        $redirectTo = match((int) $user->rol_id) {
            1 => '/admin/dashboard',
            3 => '/vendedor/ventas',
            2 => '/tienda/catalogo',
            default => '/home',
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
                'rol_id'           => $user->rol_id,
                'rol_nombre'       => $user->rol->nombre ?? 'Sin rol',
            ]
        ], 200);
    }

    /**
     * LOGOUT — Requiere login
     * Invalida únicamente el token actual del dispositivo.
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