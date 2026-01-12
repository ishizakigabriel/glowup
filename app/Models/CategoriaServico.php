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
    ];
}
