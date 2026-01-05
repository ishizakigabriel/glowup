<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaServico extends Model
{
    //
    protected $table = 'categoria_servico';

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
    ];
}
