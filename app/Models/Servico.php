<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    //
    use SoftDeletes;

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
