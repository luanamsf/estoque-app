<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendaItem extends Model
{
    // use HasFactory;
    protected $fillable = [
        'venda_id',
        'produto_id',
        'valorVenda',
        'quantidade',
        'valorTotalItem',
    ];
}

