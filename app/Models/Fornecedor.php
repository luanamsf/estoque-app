<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'nomeFantasia',
        'razaoSocial',
        'cnpj',
        'telefone',
        'email',
        'observacao',
        'margem',
        'prazoPagamento'
    ];
}
