<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cliente extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'telefone',
        'aniversario',
        'observacao'
    ];
}