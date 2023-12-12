<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $fillable = [
        'descricao_tipo',
        'abreviacao_tipo',
    ];
}
