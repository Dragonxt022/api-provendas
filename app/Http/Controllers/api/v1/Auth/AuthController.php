<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'login' => 'required|string', // Pode ser email ou username
            'password' => 'required|string',
        ]);

        // Busca o usuário pelo email ou username
        $user = User::where('email', $validated['login'])
                    ->orWhere('username', $validated['login'])
                    ->first();

        // Verificação das credenciais
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Geração do token de autenticação
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retorno da resposta JSON
        return response()->json([
            'message' => 'Login successful!',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'username' => $user->username,
                'email' => $user->email,
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    // Método de Logout
    public function logout(Request $request)
    {
        // Revogar o token do usuário atual
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    // Método para pegar os detalhes do usuário (Perfil)
    public function perfil(Request $request)
    {
        // Verifica se o usuário está autenticado
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Retorna os dados do usuário autenticado formatados com o recurso
        return new UserResource($request->user());
    }



    // Estamos trabalhando nisso!!!



}
