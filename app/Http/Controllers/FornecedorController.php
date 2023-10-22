<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function criaFornecedor(Request $request)
    {
        $data = $request->validate([
            'nomeFantasia'    => 'required|string|max:255',
            'razaoSocial'     => 'required|string|max:255',
            'cnpj'            => 'nullable|string|max:255',
            'telefone'        => 'nullable|string|max:255',
            'email'           => 'nullable|string|max:255',
            'observacao'      => 'nullable|string|max:255',
            'margem'          => 'nullable|integer|max:255',
            'prazoPagamento'  => 'nullable|integer|max:255',
        ]);

        Fornecedor::create($data);

        return redirect()->route('fornecedores')->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function listaFornecedor()
    {
        $fornecedores = Fornecedor::all();

        return view('fornecedores', compact('fornecedores'));
    }
}
