<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário existe
        if (! $user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        // Verifica se a senha está correta
        if (! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Senha incorreta.'], 401);
        }

        // Remove todos os tokens anteriores do usuário para garantir que apenas o atual seja válido
        $user->tokens()->delete();

        // Cria um novo token (padrão do Sanctum é sem expiração)
        $token = $user->createToken('mobile_app')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Cria um novo token para o usuário
        $token = $user->createToken('mobile_app')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }
}
