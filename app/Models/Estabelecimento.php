<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estabelecimento extends Model
{
    //
    protected $table = 'estabelecimento';

    protected $fillable = [
        'nome',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'email',
        'lat',
        'long',
    ];

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'estabelecimento_id', 'id');
    }   
}
