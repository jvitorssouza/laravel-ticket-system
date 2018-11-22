<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/* USES MODELS */
use App\Models\Perfis;
use App\Models\PerfisPermissoes;
use App\Models\Permissoes;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sys_credencial';

    protected $primaryKey = 'credencial_codigo';


    protected $appends = ['all_permissions','can'];

    protected $fillable = [
        'credencial_nome',
        'credencial_email',
        'credencial_login',
        'credencial_senha',
        'credencial_ativo',
        'credencial_exige_nova_senha',
        'credencial_qtd_acesso',
        'credencial_ult_acesso'
    ];

    protected $hidden = [
        'credencial_senha', 'remember_token',
    ];

    public function getAuthPassword(){
        return $this->credencial_senha;
    }

    public function getAllPermissionsAttribute()
    {
        return $this->permissoes();
    }

    public function permissoes(){
        $permissoes = PerfisPermissoes::where('perfil_codigo', $this->perfil_codigo)->with('sys_permissoes')->pluck('permissao_codigo');
        return  Permissoes::whereIn('permissao_codigo', $permissoes)->get();
    }

    public function getCanAttribute()
    {
        $permissions = [];
        foreach (Permissoes::all() as $permission) {
            if ($this->can($permission->permissao_descricao)) {
                $permissions[$permission->permissao_descricao] = true;
            } else {
                $permissions[$permission->permissao_descricao] = false;
            }
        }
        return $permissions;
    }

    public function perfil(){
        return $this->belongsTo(Perfis::class, 'perfil_codigo', '');
    }

    public function superUsuario(){
        return $this->perfil_codigo == 1 ? true : false;
    }

    public function possuiPermissao($permissao)
    {
        $permissoes = $this->permissoes()->where('permissao_codigo', $permissao->permissao_codigo);
        return $permissoes->isEmpty() ? false : true;
    }

}
