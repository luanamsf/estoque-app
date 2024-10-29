<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'cnpj',
        'razaoSocial',
        'fantasia',
        'InscEstadual',
        'telefone',
        'email',
        'website',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'tipo',
        'segmento',
        'nomeResponsavel',
        'telefoneResponsavel',
        'emailResponsavel',
    ];
}
