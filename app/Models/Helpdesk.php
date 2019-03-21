<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    protected $table = 'pro_helpdesk';
    protected $primaryKey = 'helpdesk_codigo';

    protected $fillable = [
        'status_codigo',
        'credencial_codigo_cliente',
        'credencial_codigo_atendente',
        'categoria_codigo',
        'helpdesk_titulo',
        'helpdesk_detalhes',
        'prioridade_codigo'
    ];

    public function categoria(){
        return $this->belongsTo(Categorias::class, 'categoria_codigo', '');
    }

    public function cliente(){
        return $this->belongsTo(User::class, 'credencial_codigo_cliente', 'credencial_codigo');
    }

    public function atendente(){
        return $this->belongsTo(User::class, 'credencial_codigo_atendente', 'credencial_codigo');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_codigo', '');
    }
}
