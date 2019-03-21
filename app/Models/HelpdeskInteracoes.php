<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpdeskInteracoes extends Model
{
    protected $table = 'pro_helpdesk_interacoes';
    protected $primaryKey = 'interacoes_codigo';

    protected $fillable = [
        'helpdesk_codigo',
        'interacoes_descricao',
        'credencial_codigo'
    ];
}
