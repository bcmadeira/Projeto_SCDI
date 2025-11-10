<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Doador extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'doadores';

    protected $fillable = [
<<<<<<< HEAD
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
=======
        'nome',
        'cpf_cnpj',
        'telefone',
        'email',
        'password',
        'endereco',
        'cidade',
        'tipo_doador'
>>>>>>> origin/main
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
