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
        'instituicao_id',
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}
