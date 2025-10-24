<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicoes';

    protected $fillable = [
        'nome', 'cnpj', 'ramo', 'telefone', 'telefone2',
        'localizacao', 'endereco', 'cidade', 'cep', 'email', 'descricao'
    ];

    public function campanhas()
    {
        return $this->hasMany(Campanha::class);
    }

    public function doacoes()
    {
        return $this->hasMany(Doacao::class);
    }
}
