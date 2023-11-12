<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'cliente_id',
        'user_id',
        'dataVenda',
        'valorTotalVenda',
        'modoPagamento',
    ];
}