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
        'estabelecimento_id',
        'horas_cancelamento'
    ];

    public function estabelecimento()
    {
        return $this->belongTo(Estabelecimento::class, 'estabelecimento_id', 'id');
    }

    public function colaboradoresCapacitados()
    {
        return $this->belongsToMany(Colaborador::class, 'colaborador_servico', 'servico_id', 'colaborador_id');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaServico::class, 'categoria_servico_id', 'id');
    }

}
