<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpdeskAnexos extends Model
{
    protected $table = 'pro_helpdesk_anexos';
    protected $primaryKey = 'anexos_codigo';

    protected $fillable = [
        'anexos_caminho',
        'helpdesk_codigo'
    ];
}
