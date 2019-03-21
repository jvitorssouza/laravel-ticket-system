<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'pro_helpdesk_status';
    protected $primaryKey = 'status_codigo';

    protected $fillable = [
        'status_descricao'
    ];
}
