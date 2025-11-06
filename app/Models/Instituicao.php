<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instituicao extends Model
{
    use HasFactory;

    protected $table = 'instituicoes';

    protected $fillable = [
        'nome',
        'cnpj',
        'ramo',
        'telefone',
        'telefone2',
        'localizacao',
        'endereco',
        'cidade',
        'cep',
        'email',
        'descricao',
    ];
}
