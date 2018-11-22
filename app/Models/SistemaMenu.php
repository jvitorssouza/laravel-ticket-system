<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SistemaMenu extends Model
{
    protected $table = 'sys_menu';
    protected $primaryKey = 'menu_codigo';

    protected $fillable = [
        'menu_titulo',
        'menu_rota',
        'menu_icone',
        'menu_pai',
        'menu_ordem'
    ];

    public function subMenus(){
        return $this->hasMany('App\Models\SistemaMenu', 'menu_pai', 'menu_codigo');
    }
}
