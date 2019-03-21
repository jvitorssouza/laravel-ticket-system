<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $table = 'pro_empresas';
    protected $primaryKey = 'empresa_codigo';

    protected $fillable = [
        'empresa_rzsocial',
        'empresa_fantasia',
        'empresa_cnpj',
        'empresa_logradouro',
        'empresa_numero',
        'empresa_bairro',
        'empresa_cidade',
        'empresa_uf',
        'empresa_cep'
    ];
}
