<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
    //
    use SoftDeletes;

    protected $table = 'foto';

    protected $fillable = [
        'foto',
        'descricao',
        'ordem',
        'estabelecimento_id'
    ];

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimento::class, 'estabelecimento_id', 'id');
    }
}
