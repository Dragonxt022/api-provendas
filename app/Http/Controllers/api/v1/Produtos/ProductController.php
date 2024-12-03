<?php

namespace App\Http\Controllers\api\v1\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductResource;
use App\Models\Product;
use App\Models\Product_variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $products = Product::withoutGlobalScope(FilterByCompanyScope::class)->get();
        $query = Product::with(['promotions', 'variations', 'combos']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('sku', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(50);

        return response()->json([
            'data' => ProductResource::collection($products),
            'links' => [
                'first' => $products->url(1),
                'last' => $products->url($products->lastPage()),
                'prev' => $products->previousPageUrl(),
                'next' => $products->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $products->currentPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem(),
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'last_page' => $products->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user(); // Pega o usuário autenticado
        $empresaId = $user->empresa_id; // Acessa o empresa_id do usuário autenticado

        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:50|unique:products,sku', // SKU deve ser único
            'barcode' => 'nullable|string|max:50', // Código de barras opcional
            'description' => 'nullable|string', // Descrição do produto opcional
            'category_id' => 'nullable|exists:categories,id', // Categoria do produto (opcional, mas se informado, precisa existir)
            'price' => 'required|numeric', // Preço obrigatório
            'cost_price' => 'nullable|numeric', // Preço de custo opcional
            'stock_quantity' => 'required|integer|min:0', // Quantidade de estoque obrigatória e não pode ser negativa
            'min_stock' => 'nullable|integer|min:0', // Quantidade mínima de estoque opcional
            'image_path' => 'nullable|url', // URL da imagem do produto opcional
            'ncm_code' => 'nullable|string|max:10', // Código NCM opcional
            'supplier_id' => 'nullable|exists:suppliers,id', // Fornecedor (opcional, mas se informado, precisa existir)
            'expiration_date' => 'nullable|date', // Data de validade opcional
            'is_active' => 'nullable|boolean', // Se o produto está ativo, opcional
            'is_managed' => 'nullable|boolean', // Se o produto será gerenciado, opcional
            'empresa_id' => 'required|exists:empresas,id', // Empresa (obrigatória, baseada no usuário autenticado)
            // Variações (se habilitado)
            'enable_variations' => 'nullable|boolean',
            'variations' => 'nullable|array',
            'variations.*.name' => 'nullable|string|max:255',
            'variations.*.sku' => 'nullable|string|max:50',
            'variations.*.price' => 'nullable|numeric',
            'variations.*.stock_quantity' => 'required|integer|min:0',
            'variations.*.is_active' => 'nullable|boolean',
        ]);

        // Criação do produto
        $product = Product::create([
            'name' => $request->name,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock_quantity' => $request->stock_quantity,
            'min_stock' => $request->min_stock ?? 5, // Valor padrão para min_stock
            'is_active' => $request->is_active ?? true, // Valor padrão para is_active
            'is_managed' => $request->is_managed ?? false, // Valor padrão para is_managed
            'image_path' => $request->image_path,
            'ncm_code' => $request->ncm_code,
            'supplier_id' => $request->supplier_id,
            'expiration_date' => $request->expiration_date,
            'empresa_id' => $empresaId, // Usando o empresa_id do usuário autenticado
        ]);

        // Criar variações se ativado
        if ($request->enable_variations && $request->has('variations')) {
            foreach ($request->variations as $variation) {
                $product->variations()->create([
                    'name' => $variation['name'],
                    'sku' => $variation['sku'],
                    'price' => $variation['price'],
                    'stock_quantity' => $variation['stock_quantity'],
                    'is_active' => $variation['is_active'] ?? true,
                ]);
            }
        }

        // Resposta de sucesso
        return response()->json([
            'message' => 'Produto cadastrado com sucesso!',
            'product' => $product,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Busque o produto pelo ID
        $product = Product::findOrFail($id);

        // Retorne o produto usando o ProductResource
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user(); // Pega o usuário autenticado
        $empresaId = $user->empresa_id; // Acessa o empresa_id do usuário autenticado

        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'price' => 'required|numeric',
            'cost_price' => 'nullable|numeric',
            'stock_quantity' => 'required|integer',
            'min_stock' => 'nullable|integer',
            'image_path' => 'nullable|url',
            'ncm_code' => 'nullable|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'expiration_date' => 'nullable|date',
            'enable_variations' => 'nullable|boolean',
            'variations' => 'nullable|array',
            'variations.*.name' => 'nullable|string|max:255',
            'variations.*.sku' => 'required|string|max:255',
            'variations.*.price' => 'nullable|numeric',
            'variations.*.stock_quantity' => 'required|integer',
            'variations.*.is_active' => 'required|boolean',
            'promotion_ids' => 'nullable|array',
            'promotion_ids.*' => 'exists:promotions,id',
            'combo_ids' => 'nullable|array',
            'combo_ids.*' => 'exists:combos,id',
        ]);

        // Buscar o produto a ser atualizado
        $product = Product::findOrFail($id);

        // Atualizar o produto
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'stock_quantity' => $request->stock_quantity,
            'min_stock' => $request->min_stock,
            'is_active' => $request->is_active ?? 1,
            'is_managed' => $request->is_managed ?? 0,
            'image_path' => $request->image_path,
            'ncm_code' => $request->ncm_code,
            'supplier_id' => $request->supplier_id,
            'expiration_date' => $request->expiration_date,
            'empresa_id' => $empresaId, // Usando o empresa_id do usuário autenticado
        ]);

        // Atualizar promoções associadas ao produto
        if ($request->has('product_id')) {
            $product->promotions()->sync($request->promotion_ids);
        }

        // Atualizar combos associados ao produto
        if ($request->has('product_id')) {
            $product->combos()->sync($request->combo_ids);
        }

        // Atualizar variações, se ativadas
        if ($request->enable_variations && $request->has('variations')) {
            foreach ($request->variations as $variation) {
                $product->variations()->updateOrCreate(
                    ['sku' => $variation['sku']], // Identificar a variação pela SKU
                    [
                        'name' => $variation['name'],
                        'price' => $variation['price'],
                        'stock_quantity' => $variation['stock_quantity'],
                        'is_active' => $variation['is_active'] ?? true,
                    ]
                );
            }
        }

        // Resposta de sucesso
        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product,
        ], 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user(); // Pega o usuário autenticado
        $empresaId = $user->empresa_id; // Acessa o empresa_id do usuário autenticado

        // Verifica se o produto existe e pertence à empresa do usuário autenticado
        $product = Product::where('id', $id)
            ->where('empresa_id', $empresaId) // Corrigido para usar $empresaId
            ->first();

        // Se não encontrar o produto ou ele não pertencer à empresa
        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado ou você não tem permissão para excluí-lo.',
            ], 404);
        }

        // Deleta o produto
        $product->delete();

        return response()->json([
            'message' => 'Produto excluído com sucesso.',
        ], 200);
    }



}
