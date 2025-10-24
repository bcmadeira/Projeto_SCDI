<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_fim',
        'instituicao_id'
    ];

    protected $dates = ['data_inicio', 'data_fim'];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function doacoes()
    {
        return $this->hasMany(Doacao::class, 'instituicao_id', 'instituicao_id')
                    ->whereBetween('data_doacao', [$this->data_inicio, $this->data_fim]);
    }
}
