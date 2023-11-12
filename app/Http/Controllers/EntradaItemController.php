<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaItem;

class EntradaItemController extends Controller
{
    public function entryItems(Request $request)
    {
        $data = $request->validate([
            'entrada_id'          => 'required|integer',
            'produto_id'          => 'required|integer',
            'valorEntrada'        => 'string|max:255',
            'quantidade'          => 'required|string|max:255',
            'valorTotalItem'      => 'required|string|max:255',
        ]);

        EntradaItem::create($data);

        return view('entradas'); 
    }
}
