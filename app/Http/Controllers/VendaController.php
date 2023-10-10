<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Cliente;


class VendaController extends Controller
{

    public function sale(Request $request)
    {
        $data = $request->validate([
            'cliente_id'    => 'required|integer',
            'user_id'       => 'required|integer',
            'valorTotal'    => 'required|string|max:255',
            'modoPagamento' => 'required|string|max:255',
        ]);

        // Buscar todos os clientes
        // $clientesId = Cliente::all();

        // Criar venda
        Venda::create($data);

        return redirect()->route('vendas')->with('success', 'Venda registrada com sucesso.');
    }

        // listar clientes
        public function clientList()
        {
            $clientesId = Cliente::all();
    
            return view('vendas', ['clientesId' => $clientesId]);
        }


    // lista as vendas
    public function saleList()
    {
        $vendas = venda::all();

        return view('vendas', compact('vendas'));
    }

}
