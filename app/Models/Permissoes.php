<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{

    protected $table = 'sys_permissoes';
    protected $primaryKey = 'permissao_codigo';

    protected $fillable = [
        'permissao_descricao',
        'permissao_rota'
    ];
}
