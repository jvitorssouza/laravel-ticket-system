<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfis extends Model
{

    protected $table = 'sys_perfil_acesso';
    protected $primaryKey = 'perfil_codigo';

    protected $fillable = [
        'perfil_descricao'
    ];
}
