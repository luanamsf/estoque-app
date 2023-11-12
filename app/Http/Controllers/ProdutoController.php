<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Models\Produto;


class ProdutoController extends Controller
{
    //
    public function store(Request $request)
{
    $data = $request->validate([
        'produto'       => 'required|string|max:255',
        'codigo'        => 'required|string|max:255',
        'tipo'          => 'required|string|max:255',
        'fornecedor_id' => 'nullable|integer',
        'unidade'       => 'nullable|string|max:255',
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


        // listar fornecedores
        public function FornecedorList()
        {
            $FornecedoresId = Fornecedor::all();
    
            return view('cadastro', ['FornecedoresId' => $FornecedoresId]);
        }


    public function estoque()
    {
        $produtos = Produto::all();

        return view('estoque', compact('produtos'));
    }

    public function edit(Produto $produto)
    {
        $FornecedoresId = Fornecedor::all();
        // Retornar a view de edição com o produto específico
        return view('cadastro', compact('produto'), ['FornecedoresId' => $FornecedoresId]);
    }

    public function update(Request $request, Produto $produto)
    {
        // Validação dos campos do formulário de edição
        $request->validate([
            'produto'       => 'required',
            'codigo'        => 'required',
            'tipo'          => 'required',
            'fornecedor_id' => 'required',
            'valorCusto'    => 'required',
            'valorVenda'    => 'required',
            'quantidade'    => 'required',
        ]);

        // Atualizar o produto com base nos dados do formulário
        $produto->update($request->all());

        // Redirecionar de volta à página de estoque ou qualquer outra rota desejada
        return redirect()->route('estoque')->with('success', 'Produto atualizado com sucesso.');
    }
}
