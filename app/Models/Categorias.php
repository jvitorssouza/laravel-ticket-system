<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'pro_categorias';
    protected $primaryKey = 'categoria_codigo';

    protected $fillable = [
        'categoria_descricao',
        'departamento_codigo',
        'prioridade_codigo',
        'categoria_cor'
    ];

    public function prioridade(){
        return $this->belongsTo(Prioridades::class, 'prioridade_codigo', '');
    }
}
