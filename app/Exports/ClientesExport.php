<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cliente::orderBy('nome')
            ->get(['nome', 'cpf', 'telefone', 'email','endereco','aniversario', 'observacao']);
    }

    public function headings(): array
    {
        return ['Nome', 'CPF', 'Telefone' , 'E-mail', 'Endereço' ,'Aniversário', 'Observação'];
    }
}


