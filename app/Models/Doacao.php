<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $table = 'doacoes';

    protected $fillable = [
        'tipo_doacao',
        'descricao',
        'quantidade',
        'valor',
        'data_doacao',
        'status',
        'instituicao_id',
        'doador_id'
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function doador()
    {
        return $this->belongsTo(Doador::class);
    }

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }
}
