<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Produto extends Model
{
    protected $fillable = [
        'produto',
        'codigo',
        'tipo',
        'fornecedor_id',
        'unidade',
        'valorCusto',
        'valorVenda',
        'quantidade',
        'status',
    ];
}
