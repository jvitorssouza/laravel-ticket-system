<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfisPermissoes extends Model
{
    protected $table = 'sys_perfis_permissoes';
    protected $primaryKey = 'perfil_permissao_codigo';

    protected $fillable = [
        'perfil_codigo',
        'permissao_codigo'
    ];
}
