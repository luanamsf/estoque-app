<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedor;


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
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }
}