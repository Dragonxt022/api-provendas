<?php

namespace App\Http\Controllers\api\v1\Fornecedores;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    // Método para obter o fornecedor filtrado pela empresa
    protected function getSupplierById($id)
    {
        return Supplier::where('id', $id)
            ->where('empresa_id', Auth::user()->empresa_id)  // Usando Auth::user() para pegar o ID da empresa
            ->first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Obtém os fornecedores filtrados pela empresa do usuário autenticado
        $suppliers = Supplier::where('empresa_id', $user->empresa_id)->get();

        return response()->json([
            'message' => 'Lista de fornecedores.',
            'data' => $suppliers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:18|unique:suppliers,cnpj',
            'cpf' => 'nullable|string|max:14|unique:suppliers,cpf',
            'contact_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:150|email',
            'address' => 'nullable|string',
            'image_path' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        // Obtém o usuário autenticado
        $user = Auth::user();

        // Criação do fornecedor associado à empresa do usuário autenticado
        $supplier = Supplier::create(array_merge($validated, [
            'empresa_id' => $user->empresa_id,
        ]));

        return response()->json([
            'message' => 'Fornecedor criado com sucesso.',
            'data' => $supplier,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtém o fornecedor pela empresa do usuário autenticado
        $supplier = $this->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Fornecedor não encontrado.'], 404);
        }

        return response()->json([
            'message' => 'Detalhes do fornecedor.',
            'data' => $supplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obtém o fornecedor pela empresa do usuário autenticado
        $supplier = $this->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Fornecedor não encontrado.'], 404);
        }

        // Validação dos dados de atualização
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'cnpj' => 'nullable|string|max:18|unique:suppliers,cnpj,' . $supplier->id,
            'cpf' => 'nullable|string|max:14|unique:suppliers,cpf,' . $supplier->id,
            'contact_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|string|max:150|email',
            'address' => 'nullable|string',
            'image_path' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        // Atualiza os dados do fornecedor
        $supplier->update($validated);

        return response()->json([
            'message' => 'Fornecedor atualizado com sucesso.',
            'data' => $supplier,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Obtém o fornecedor pela empresa do usuário autenticado
        $supplier = $this->getSupplierById($id);

        if (!$supplier) {
            return response()->json(['message' => 'Fornecedor não encontrado.'], 404);
        }

        // Deleta o fornecedor
        $supplier->delete();

        return response()->json(['message' => 'Fornecedor excluído com sucesso.']);
    }
}
