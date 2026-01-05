<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    //
    protected $table = 'servico';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'tempo_medio_duracao',
        'preco',
        'categoria_servico_id',
        'estabelecimento_id'
    ];

    public function estabelecimento()
    {
        return $this->belongTo(Estabelecimento::class, 'estabelecimento_id', 'id');
    }

}
