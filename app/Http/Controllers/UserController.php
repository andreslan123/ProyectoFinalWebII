<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // 🔐 Fachada necesaria para encriptar y verificar contraseñas

class UserController extends Controller
{
    /**
     * 👁️ 1. INDEX: Listar todos los usuarios
     * Explicación para la defensa: Retorna la colección completa de usuarios. 
     * Usamos Eager Loading (with) para traer de un solo golpe los datos de las tablas relacionadas 
     * (roles y estados) evitando el problema de consultas N+1 en la base de datos.
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => User::with('rol', 'estado')->get()
        ]);
    }

    /**
     * 📝 2. STORE: Registrar un nuevo usuario (Sign Up)
     * Explicación para la defensa: Recibe los datos del formulario/API, los valida fuertemente 
     * asegurando la integridad de llaves foráneas (:roles,id) y unicidad (unique:users).
     * La contraseña se almacena usando Hash::make (algoritmo Bcrypt) por seguridad.
     */
    public function store(Request $request)
    {
        // 🛡️ Reglas de validación: Si falla, Laravel frena aquí y responde los errores
        $request->validate([
            'rol_id'           => 'required|exists:roles,id',           // Debe existir en la tabla roles
            'estado_id'        => 'required|exists:estados_general,id', // Debe existir en la tabla estados
            'name'             => 'required|string|max:150',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',             // nullable = opcional
            'ci'               => 'nullable|string|max:15|unique:users,ci', // No pueden haber dos CI iguales
            'email'            => 'required|email|unique:users,email',    // No pueden haber dos correos iguales
            'password'         => 'required|string|min:6',              // Mínimo 6 caracteres
        ]);
 
        // 💾 Inserción en la base de datos
        $user = User::create([
            'rol_id'           => $request->rol_id,
            'estado_id'        => $request->estado_id,
            'name'             => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'ci'               => $request->ci,
            'email'            => $request->email,
            'password'         => Hash::make($request->password), // 🔐 Encriptación obligatoria
        ]);

        // Retorna un código HTTP 201 (Created) junto al usuario y sus relaciones cargadas
        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $user->load('rol', 'estado') 
        ], 201);
    }

    /**
     * 🔍 3. SHOW: Mostrar un usuario específico por su ID
     * Explicación para la defensa: Busca un registro por su llave primaria.
     * Si no existe, maneja el error manualmente devolviendo un código HTTP 404 (Not Found)
     * en lugar de romper la API.
     */
    public function show($id)
    {
        // Busca al usuario cargando sus relaciones de golpe
        $user = User::with('rol', 'estado')->find($id);

        // Si el find() devuelve null, el ID no existe en la BD
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

    /**
     * 🔄 4. UPDATE: Modificar datos de un usuario existente
     * Explicación para la defensa: Aplica validaciones parciales usando 'sometimes'.
     * Además, concatena el .' ,'.$id en las reglas 'unique' para decirle a MySQL:
     * "Verifica que nadie más tenga este email/CI, pero ignora al usuario que estoy editando actualmente".
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // Validamos. 'sometimes' significa: "si el campo viene en la petición, valídalo; si no viene, ignóralo".
        $request->validate([
            'rol_id'           => 'sometimes|required|exists:roles,id',
            'estado_id'        => 'sometimes|required|exists:estados_general,id',
            'name'             => 'sometimes|required|string|max:150',
            'apellido_paterno' => 'sometimes|required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'ci'               => 'nullable|string|max:15|unique:users,ci,' . $id,    // Ignora este ID en el chequeo
            'email'            => 'sometimes|required|email|unique:users,email,' . $id, // Ignora este ID en el chequeo
            'password'         => 'nullable|string|min:6', // Opcional al editar
        ]);

        $data = $request->all();

        // 🧠 Filtro de contraseña inteligente:
        // filled() verifica que el campo no sea nulo, que exista, y que NO sea una cadena vacía ("").
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Si escribió una nueva clave, se encripta
        } else {
            unset($data['password']); // Si no envió clave o mandó "", la quitamos del arreglo para conservar la actual de la BD
        }

        // Guarda los cambios en MySQL
        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $user->load('rol', 'estado')
        ]);
    }

    /**
     * ❌ 5. DESTROY: Eliminar un usuario físicamente de la base de datos
     * Explicación para la defensa: Ejecuta un DELETE directo en la base de datos.
     * Nota de arquitectura: Si el usuario ya tiene llaves foráneas registradas en la tabla 'pedidos',
     * MySQL bloqueará esta acción lanzando una QueryException (error 1451).
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // ⚠️ Borrado físico de la fila. Romperá la integridad si tiene pedidos asociados.
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuario eliminado correctamente'
        ]);
    }

    /**
     * 🔐 6. LOGIN: Autenticación de usuarios y emisión de Tokens (Sanctum)
     * Explicación para la defensa: Es el endpoint que da acceso al sistema.
     * Evalúa las credenciales en texto plano contra el hash de la BD usando Hash::check().
     * Si todo coincide, genera un Bearer Token único para el control de sesiones sin estado (Stateless API).
     */
    public function login(Request $request)
    {
        // 1. Validamos los datos de entrada mínimos
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Buscamos si el correo pertenece a algún usuario
        $user = User::where('email', $request->email)->first();

        // 3. Control de acceso: Si el usuario no existe, u Hash::check da false, rebota con 401 (No Autorizado)
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Las credenciales ingresadas son incorrectas'
            ], 401); 
        }

        // 🚀 Control extra: Si el usuario tiene estado_id = 2 (Inactivo/Baneado), le negamos la entrada
        if ($user->estado_id == 2) { 
            return response()->json([
                'status'  => false,
                'message' => 'Este usuario se encuentra inactivo. Comuníquese con el administrador.'
            ], 403); // 403 = Prohibido (Forbidden)
        }

        // 4. Generamos el token de seguridad único usando la librería interna Laravel Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 🧠 LÓGICA DE REDIRECCIÓN EN EL FRONTEND:
        // Definimos una ruta por defecto en base al rol_id para ahorrarle lógica pesada al frontend.
        $redirectTo = '/home'; 

        if ($user->rol_id == 1) {
            $redirectTo = '/admin/dashboard'; // Rol 1 va al panel de control total de administrador
        } elseif ($user->rol_id == 3) {
            $redirectTo = '/vendedor/ventas';  // Rol 3 va directo a la caja de facturación
        } elseif ($user->rol_id == 2) {
            $redirectTo = '/tienda/catalogo';  // Rol 2 (Cliente externo) va a ver los productos disponibles
        }

        // 5. Respondemos con éxito inyectando el Token y la información del perfil del usuario
        return response()->json([
            'status'       => true,
            'message'      => '¡Bienvenido al sistema!',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'redirect_to'  => $redirectTo, 
            'user'         => [
                'id'               => $user->id,
                'name'             => $user->name,
                'apellido_paterno' => $user->apellido_paterno,
                'email'            => $user->email,
                'rol_id'           => $user->rol_id, 
                'rol_nombre'       => $user->rol->nombre ?? 'Sin Rol' // Trae el nombre del rol si existe la relación
            ]
        ], 200);
    }
}