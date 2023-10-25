<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\VendaItem;

class VendaController extends Controller
{
    public function sale(Request $request)
{
    // Valide os dados do formulário
    $data = $request->validate([
        'cliente_id'       => 'required|integer',
        'user_id'          => 'required|integer',
        'dataVenda'        => 'string|max:255',
        'valorTotalVenda'  => 'required|string|max:255',
        'modoPagamento'    => 'required|string|max:255',
        'produto_id.*'     => 'required|integer', // Agora, permitimos vários produtos
        'valorVenda.*'     => 'required|string',
        'quantidade.*'     => 'required|integer',
        'valorTotalItem.*' => 'required|string',
    ]);

    // Crie uma nova venda
    $venda = Venda::create([
        'cliente_id'      => $data['cliente_id'],
        'user_id'         => $data['user_id'],
        'dataVenda'       => $data['dataVenda'],
        'valorTotalVenda' => $data['valorTotalVenda'],
        'modoPagamento'   => $data['modoPagamento'],
    ]);

    // Agora, percorra os produtos vendidos e salve-os na tabela "vendasItens"
    for ($i = 0; $i < count($data['produto_id']); $i++) {
        VendaItem::create([
            'venda_id'       => $venda->id,
            'produto_id'     => $data['produto_id'][$i],
            'valorVenda'     => $data['valorVenda'][$i],
            'quantidade'     => $data['quantidade'][$i],
            'valorTotalItem' => $data['valorTotalItem'][$i],
        ]);
    }

    return redirect()->route('vendas')->with('success', 'Venda registrada com sucesso.');
}

    public function clientProductList()
    {
        $clientesId = Cliente::all();
        $produtosId = Produto::all();

        return view('vendas', ['clientesId' => $clientesId, 'produtosId' => $produtosId]);
    }

    public function saleList()
    {
        $vendas = Venda::all();

        return view('vendas', compact('vendas'));
    }
}
