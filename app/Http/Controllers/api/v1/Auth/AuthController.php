<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Models\User;
use App\Models\Empresa;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Método de Login
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

    // Método de Registro
    public function register(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'empresa_name' => 'required|string|max:255',
            'empresa_cnpj' => 'required|string|max:18|unique:empresas,cnpj',
            'empresa_phone' => 'required|string|max:20',
            'empresa_address' => 'required|string|max:255',
            'empresa_city' => 'required|string|max:255',
            'empresa_state' => 'required|string|max:255',
            'empresa_zip_code' => 'required|string|max:10',
            'empresa_website' => 'nullable|string|max:255',
            'empresa_social_media' => 'nullable|json',
            'empresa_logo' => 'nullable|string|max:255',
            'empresa_fiscal_status' => 'nullable|string|max:255',
            'empresa_company_type' => 'required|in:MEI,LTDA,EIRELI,SA,Outros',
            'empresa_operating_since' => 'nullable|date',
        ]);

        // Criação da empresa
        $empresa = Empresa::create([
            'name' => $validated['empresa_name'],
            'cnpj' => $validated['empresa_cnpj'],
            'email' => $validated['email'],
            'phone' => $validated['empresa_phone'],
            'address' => $validated['empresa_address'],
            'city' => $validated['empresa_city'],
            'state' => $validated['empresa_state'],
            'zip_code' => $validated['empresa_zip_code'],
            'website' => $validated['empresa_website'],
            'social_media' => $validated['empresa_social_media'] ? json_decode($validated['empresa_social_media']) : null,
            'logo' => $validated['empresa_logo'],
            'fiscal_status' => $validated['empresa_fiscal_status'] ?? 'Ativa',
            'owner_id' => null, // O owner_id será associado depois ao usuário
            'company_type' => $validated['empresa_company_type'],
            'operating_since' => $validated['empresa_operating_since'],
            'status' => true,
        ]);

        // Criação do usuário
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'empresa_id' => $empresa->id, // Associando o usuário à empresa criada
            'role' => 'usuario', // Ou outro valor conforme necessário
            'is_active' => true,
        ]);

        // Atualizando o owner_id da empresa para o usuário criado
        $empresa->update(['owner_id' => $user->id]);

        // Gerando o token de autenticação
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User and company registered successfully!',
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'username' => $user->username,
                'email' => $user->email,
                'empresa_id' => $user->empresa_id, // Incluindo a empresa associada
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

        // Retorna os dados do usuário autenticado
        return new UserResource($request->user());
    }
}
