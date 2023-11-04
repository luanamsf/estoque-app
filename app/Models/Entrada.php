<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'fornecedor_id',
        'user_id',
        'notaFiscal',
        'serieNF',
        'valorTotalEntrada',
        'dataEntrada',
    ];
}
