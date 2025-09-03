<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;

class ClienteController extends Controller
{
    public function clients(Request $request)   
    {
        $data = $request->validate([
            'nome'          => 'required|string|max:255',
            'cpf'           => 'required|string|max:255',
            'telefone'      => 'nullable|string|max:255',
            'email'         => 'nullable|string|max:255',
            'endereco'      => 'nullable|string|max:255',
            'aniversario'   => 'nullable|string|max:255',
            'observacao'    => 'nullable|string|max:255',
        ]);

        Cliente::create($data);

        return redirect()->route('clientes')->with('success', 'Cliente cadastrado(a) com sucesso.');
    }

    public function listaCliente()
    {
        $clientes = Cliente::all();

        return view('clientes', compact('clientes'));
    }

    public function relatorioClientes()
    {
        $clientes = Cliente::orderBy('nome')->get();

        return view('relatorios.clientes', compact('clientes'));
    }

    public function exportClientesPdf()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $pdf = Pdf::loadView('relatorios.clientes', compact('clientes'));
        return $pdf->download('relatorio_clientes.pdf');
    }

    public function exportClientesExcel()
    {
        return Excel::download(new ClientesExport, 'relatorio_clientes.xlsx');
    }
}
