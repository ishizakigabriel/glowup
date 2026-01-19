<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaServico extends Model
{
    //
    use SoftDeletes;

    protected $table = 'categoria_servico';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'cor_profundo',
        'cor_pastel',
        'cor_vivido'
    ];

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'categoria_servico_id', 'id');
    }

    public function cnaes()
    {
        return $this->belongsToMany(Cnae::class, 'cnae_categoria', 'categoria_servico_id', 'cnae_id');
    }
}
