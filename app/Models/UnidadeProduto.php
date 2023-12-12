<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeProduto extends Model
{
    protected $fillable = [
        'descricao_unidade',
        'abreviacao_unidade',
    ];
}
