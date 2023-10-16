<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'id',
        'nomeFantasia',
        'razaoSocial',
        'cnpj',
        'telefone',
        'email',
        'observacao'
    ];
}
