<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\TipoProduto;
use App\Models\UnidadeProduto;

class ProdutoController extends Controller
{
    //
    public function store(Request $request)
    {
        $data = $request->validate([
            'produto'       => 'required|string|max:255',
            'codigo'        => 'required|string|max:255',
            'tipo_id'       => 'required|integer',
            'fornecedor_id' => 'required|integer',
            'unidade_id'    => 'required|integer',
            'valorCusto'    => 'required|string|max:255',
            'valorVenda'    => 'required|string|max:255',
            'quantidade'    => 'nullable|integer',
        ]);

        // Verifica se já existe um produto com o mesmo ID
        $existingProduct = Produto::find($request->input('id'));

        if ($existingProduct) {
            // Se existir, atualiza o produto com os novos dados
            $existingProduct->update($data);
            return redirect()->route('estoque')->with('success', 'Produto atualizado com sucesso.');
        } else {
            // Se não existir, cria um novo produto
            Produto::create($data);
            return redirect()->route('cadastro')->with('success', 'Produto cadastrado com sucesso.');
        }
    }

    public function createProduto()
    {
        $FornecedoresId = Fornecedor::all();
        $TiposId        = TipoProduto::all();
        $UnidadesId     = UnidadeProduto::all();
        
        return view('cadastro', [
            'FornecedoresId' => $FornecedoresId,
            'TiposId'        => $TiposId,
            'UnidadesId'     => $UnidadesId,
        ]);
    }

    public function estoque()
    {
        $produtos = Produto::all();
        return view('estoque', compact('produtos'));
    }

    public function edit(Produto $produto)
    {
        $FornecedoresId = Fornecedor::all();
        $TiposId        = TipoProduto::all();
        $UnidadesId     = UnidadeProduto::all();
        
        return view('cadastro', compact('produto', 'FornecedoresId', 'TiposId', 'UnidadesId'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'produto'          => 'required',
            'codigo'           => 'required',
            'tipo_id'          => 'required',
            'fornecedor_id'    => 'required',
            'unidade_id'       => 'required',
            'valorCusto'       => 'required',
            'valorVenda'       => 'required',
            'quantidade'       => 'required',
        ]);

        $produto->update($request->all());
        return redirect()->route('estoque')->with('success', 'Produto atualizado com sucesso.');
    }
}
