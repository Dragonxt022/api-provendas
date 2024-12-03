<?php

namespace App\Http\Controllers\api\v1\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\EmpresaResource;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    // Visualzia as empresas cadastradas
    public function index()
    {
        // Recupera todas as empresas e usa o recurso para formatar a resposta
        $empresas = Empresa::all();
        return EmpresaResource::collection($empresas);
    }

    // Cria uma nova empresa
    public function store(Request $request)
    {
        // Validação dos dados recebidos para criação da empresa
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:empresas,cnpj',
            'email' => 'required|string|email|max:255|unique:empresas,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'website' => 'nullable|string|max:255',
            'social_media' => 'nullable|json',
            'logo' => 'nullable|string|max:255',
            'fiscal_status' => 'nullable|string|max:255',
            'company_type' => 'required|in:MEI,LTDA,EIRELI,SA,Outros',
            'operating_since' => 'nullable|date',
        ]);

        // Criação da empresa
        $empresa = Empresa::create([
            'name' => $validated['name'],
            'cnpj' => $validated['cnpj'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip_code' => $validated['zip_code'],
            'website' => $validated['website'],
            'social_media' => $validated['social_media'] ? json_decode($validated['social_media']) : null,
            'logo' => $validated['logo'],
            'fiscal_status' => $validated['fiscal_status'] ?? 'Ativa',
            'company_type' => $validated['company_type'],
            'operating_since' => $validated['operating_since'],
            'status' => true,  // Definido como "Ativa" por padrão
            'owner_id' => null, // Owner será atribuído posteriormente ao usuário
        ]);

        return response()->json([
            'message' => 'Company created successfully!',
            'company' => $empresa,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valida os dados recebidos para a atualização da empresa
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:18|unique:empresas,cnpj,' . $id, // Permite atualizar, mas mantém a unicidade do CNPJ
            'email' => 'nullable|string|email|max:255|unique:empresas,email,' . $id, // Permite atualizar, mas mantém a unicidade do email
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'website' => 'nullable|string|max:255',
            'social_media' => 'nullable|json',
            'logo' => 'nullable|string|max:255',
            'fiscal_status' => 'nullable|string|max:255',
            'company_type' => 'nullable|in:MEI,LTDA,EIRELI,SA,Outros',
            'operating_since' => 'nullable|date',
            'status' => 'nullable|boolean', // Permite atualizar o status da empresa
        ]);

        // Busca a empresa pelo ID
        $empresa = Empresa::find($id);

        // Verifica se a empresa existe
        if (!$empresa) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        // Atualiza os dados da empresa
        $empresa->update([
            'name' => $validated['name'] ?? $empresa->name,
            'cnpj' => $validated['cnpj'] ?? $empresa->cnpj,
            'email' => $validated['email'] ?? $empresa->email,
            'phone' => $validated['phone'] ?? $empresa->phone,
            'address' => $validated['address'] ?? $empresa->address,
            'city' => $validated['city'] ?? $empresa->city,
            'state' => $validated['state'] ?? $empresa->state,
            'zip_code' => $validated['zip_code'] ?? $empresa->zip_code,
            'website' => $validated['website'] ?? $empresa->website,
            'social_media' => $validated['social_media'] ? json_decode($validated['social_media']) : $empresa->social_media,
            'logo' => $validated['logo'] ?? $empresa->logo,
            'fiscal_status' => $validated['fiscal_status'] ?? $empresa->fiscal_status,
            'company_type' => $validated['company_type'] ?? $empresa->company_type,
            'operating_since' => $validated['operating_since'] ?? $empresa->operating_since,
            'status' => isset($validated['status']) ? $validated['status'] : $empresa->status,
        ]);

        // Retorna a resposta com os dados atualizados da empresa
        return response()->json([
            'message' => 'Company updated successfully!',
            'company' => $empresa,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
