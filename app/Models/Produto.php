<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedor;
use App\Models\TipoProduto;
use App\Models\UnidadeProduto;


class Produto extends Model
{
    protected $fillable = [
        'produto',
        'codigo',
        'tipo_id',
        'fornecedor_id',
        'unidade_id',
        'valorCusto',
        'valorVenda',
        'quantidade',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoProduto::class, 'tipo_id');
    }

    public function unidade()
    {
        return $this->belongsTo(UnidadeProduto::class, 'unidade_id');
    }
}