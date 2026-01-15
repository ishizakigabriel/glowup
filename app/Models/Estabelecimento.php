<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estabelecimento extends Model
{
    //
    use SoftDeletes;

    protected $table = 'estabelecimento';

    protected $fillable = [
        'user_id',
        'nome',
        'imagem',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'telefone',
        'email',
        'lat',
        'long',
    ];

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'estabelecimento_id', 'id');
    }   

    public function colaboradores()
    {
        return $this->hasMany(Colaborador::class, 'estabelecimento_id', 'id');
    }   

    public function galeria()
    {
        return $this->hasMany(Foto::class, 'estabelecimento_id', 'id');
    }   

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'estabelecimento_id', 'id');
    }   
}
