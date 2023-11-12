<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Produto;
use App\Models\EntradaItem;
use App\Models\Fornecedor;

class EntradaController extends Controller
{
    public function entry(Request $request)
    {
        $data = $request->validate([
            'fornecedor_id'       => 'required|integer',
            'user_id'             => 'required|integer',
            'notaFiscal'          => 'required|string|max:255',
            'serieNF'             => 'required|string|max:255',
            'valorTotalEntrada'   => 'required|string',
            'dataEntrada'         => 'string|max:255',
            'produto_id.*'        => 'required|integer',
            'valorEntrada.*'      => 'required|string',
            'quantidade.*'        => 'required|integer',
            'valorTotalItem.*'    => 'required|string',
        ]);

        $entrada = Entrada::create([
            'fornecedor_id'     => $data['fornecedor_id'],
            'user_id'           => $data['user_id'],
            'notaFiscal'        => $data['notaFiscal'],
            'serieNF'           => $data['serieNF'],
            'valorTotalEntrada' => $data['valorTotalEntrada'],
            'dataEntrada'       => $data['dataEntrada'],
        ]);

        for ($i = 0; $i < count($data['produto_id']); $i++) {

            $produto = Produto::find($data['produto_id'][$i]);
            $fornecedor = Fornecedor::find($data['fornecedor_id']);

            EntradaItem::create([
                'entrada_id'       => $entrada->id,
                'produto_id'       => $data['produto_id'][$i],
                'valorEntrada'     => $data['valorEntrada'][$i],
                'quantidade'       => $data['quantidade'][$i],
                'valorTotalItem'   => $data['valorTotalItem'][$i], 
            ]);

            // CALCULO DO NOVO VALOR DE CUSTO 
            $novoValorCusto = sprintf("%.2f", round( (($data['valorTotalItem'][$i]) + ($produto->quantidade * $produto->valorCusto)) / ($data['quantidade'][$i] + $produto->quantidade),2));         
            $produto->valorCusto = $novoValorCusto; 
            
            // CALCULO DO NOVO VALOR DE VENDA
            $margemLucro = ((100 - $fornecedor->margem) * 0.0100);
            $novoValorVenda = sprintf("%.2f", round( ($novoValorCusto / $margemLucro),2));
            $produto->valorVenda = $novoValorVenda;

            // ATUALIZA A QUANTIDADE EM ESTOQUE E SALVA NA TABELA PRODUTOS
            $produto->quantidade += $data['quantidade'][$i];
            $produto->save();
        }

        return redirect()->route('entradas')->with('success', 'Entrada registrada com sucesso.');
    }

    public function FornecedorProductList()
    {
        $fornecedoresId = Fornecedor::all();
        $produtosId = Produto::all();

        return view('entradas', ['fornecedoresId' => $fornecedoresId, 'produtosId' => $produtosId]);
    }

    public function entryList()
    {
        $entradas = Entrada::all();

        return view('entradas', compact('entradas'));
    }
}