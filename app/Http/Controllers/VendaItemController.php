<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendaItem;

class VendaItemController extends Controller
{
    public function saleItems(Request $request)
    {
        $data = $request->validate([
            'venda_id'            => 'required|integer',
            'produto_id'          => 'required|integer',
            'valorVenda'          => 'string|max:255',
            'quantidade'          => 'required|string|max:255',
            'valorTotalItem'      => 'required|string|max:255',
        ]);

        VendaItem::create($data);

        return view('vendas');
    }
}
