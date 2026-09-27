<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Autentica al usuario y le emite un Token de API.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Validamos credenciales
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.'
            ], 401);
        }

        // Generamos el token de acceso con Laravel Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso en la API.',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    /**
     * Revoca el Token del usuario (Cierre de Sesión).
     */
    public function logout(Request $request)
    {
        // Revoca únicamente el token utilizado en la petición actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token revocado y sesión cerrada correctamente.'
        ], 200);
    }
}