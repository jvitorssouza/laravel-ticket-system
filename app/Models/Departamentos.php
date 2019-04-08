<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'pro_departamentos';
    protected $primaryKey = 'departamento_codigo';

    protected $fillable = [
        'departamento_descricao',
        'departamento_cor',
        'empresa_codigo'
    ];
}
