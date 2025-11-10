<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
    protected $table = 'doadores';

    protected $fillable = [
        'nome', 
        'cpf_cnpj', 
        'telefone', 
        'email',
        'tipo_doador', 
        'endereco', 
        'cidade',
        'estado',
        'cep',
        'senha'
    ];

    public function doacoes()
    {
        return $this->hasMany(Doacao::class);
    }
}
