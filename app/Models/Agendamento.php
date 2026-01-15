<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamento extends Model
{
    //
    use SoftDeletes;

    protected $table = 'agendamento';

    protected $fillable = [
        'id',
        'user_id',
        'estabelecimento_id',
        'servico_id',
        'colaborador_id',
        'data',
        'inicio',
        'fim',
        'status'
    ];

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class, 'estabelecimento_id', 'id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id', 'id');
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class, 'colaborador_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
