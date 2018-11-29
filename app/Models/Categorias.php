<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'pro_categorias';
    protected $primaryKey = 'categoria_codigo';

    protected $fillable = [
        'categoria_descricao',
        'prioridade_codigo'
    ];

    public function prioridade(){
        return $this->belongsTo(Prioridades::class, 'prioridade_codigo', '');
    }
}
