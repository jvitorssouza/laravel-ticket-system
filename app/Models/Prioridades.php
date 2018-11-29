<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridades extends Model
{
    protected $table = 'pro_prioridades';
    protected $primaryKey = 'prioridade_codigo';

    protected $fillable = [
        'prioridade_descricao',
        'prioridade_grau'
    ];
}
