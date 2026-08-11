<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgot_password', 'reset_password']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Cierre de sesión exitoso']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
	    'user' => auth('api')->user() // datos del usuario
        ]);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user
        ], 201);
    }
    
    public function forgot_password(Request $request)
   {
    // 1. Validamos que el correo sea obligatorio y exista en la tabla 'users'
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'El correo electrónico no está registrado o no es válido.'
        ], 422);
    }

    // 2. Enviamos el enlace de restablecimiento usando el Broker de Laravel
    $status = Password::broker()->sendResetLink(
        $request->only('email')
    );

    // 3. Verificamos si Laravel logró generar y enviar el enlace con éxito
    if ($status === Password::RESET_LINK_SENT) {
        return response()->json([
            'message' => '¡Enlace de restablecimiento enviado con éxito a tu correo!'
        ], 200);
    }

    // Si algo falla inesperadamente en el proceso interno
    return response()->json([
        'message' => 'No se pudo enviar el correo de recuperación.'
    ], 500);
  }

  public function reset_password(Request $request)
    {
        // 1. Validamos los datos recibidos de la petición
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed', // Requiere 'password_confirmation' en la petición
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Intentamos restablecer la contraseña usando el Broker de Laravel
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Esta función define cómo se guarda la nueva contraseña en tu usuario
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        // 3. Verificamos si la base de datos se actualizó con éxito
        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'message' => '¡Tu contraseña ha sido restablecida con éxito!'
            ], 200);
        }

        // Si el token expiró o es incorrecto
        return response()->json([
            'message' => 'El enlace o código de recuperación es inválido o ha expirado.'
        ], 400);
    }

}
