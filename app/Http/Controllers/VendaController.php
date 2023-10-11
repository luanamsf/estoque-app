<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;

class VendaController extends Controller
{

    public function sale(Request $request)
    {
        $data = $request->validate([
            'cliente_id'    => 'required|integer',
            'user_id'       => 'required|integer',
            'data_venda'    => 'string|max:255',
            'valorTotal'    => 'required|string|max:255',
            'modoPagamento' => 'required|string|max:255',
        ]);

        // Criar venda
        Venda::create($data);

        return redirect()->route('vendas')->with('success', 'Venda registrada com sucesso.');
    }

    // listar clientes
    public function clientProductList(Request $request)
    {
        $clientesId = Cliente::all();

        $produtosId = Produto::all();

        $produtos = $request->input('produtos');
        $quantidades = $request->input('quantidades');

        return view('vendas', ['clientesId' => $clientesId], ['produtosId' => $produtosId], ['produtos' => $produtos], ['quantidades' => $quantidades]);
    }


    // lista as vendas
    public function saleList()
    {
        $vendas = venda::all();

        return view('vendas', compact('vendas'));
    }
}
