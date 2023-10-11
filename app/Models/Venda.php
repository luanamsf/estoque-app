<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    // use HasFactory;
    protected $fillable = [
        'cliente_id',
        'user_id',
        'data_venda',
        'valorTotal',
        'modoPagamento',
    ];
}
