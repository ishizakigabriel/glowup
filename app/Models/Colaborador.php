<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    //
    use SoftDeletes;
    protected $table = 'colaborador';

    protected $fillable = [
        'nome',
        'biografia',
        'foto',
        'estabelecimento_id',
        'avaliacao_media'
    ];

    public function estabelecimento()
    {
        return $this->belongTo(Estabelecimento::class, 'estabelecimento_id', 'id');
    }
}
