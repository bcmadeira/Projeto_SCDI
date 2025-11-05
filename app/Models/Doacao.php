<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $table = 'doacoes';

    protected $fillable = [
        'tipo_doacao', 'descricao', 'quantidade', 'valor',
        'data_doacao', 'status', 'instituicao_id', 'doador_id'
    ];

    protected $dates = ['data_doacao'];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function doador()
    {
        return $this->belongsTo(Doador::class);
    }
}
