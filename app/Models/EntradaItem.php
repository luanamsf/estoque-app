<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntradaItem extends Model
{
    protected $fillable = [
        'entrada_id',
        'produto_id',
        'valorEntrada',
        'quantidade',
        'valorTotalItem',
    ];
}