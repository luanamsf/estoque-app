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
            'status'        => 'nullable|string|max:255',
        ]);

        Produto::create($data);

        return redirect()->route('cadastro')->with('success', 'Produto cadastrado com sucesso.');
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
}
