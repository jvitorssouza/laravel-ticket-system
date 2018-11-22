<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\Permissoes;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot(GateContract $gate, Request $request)
    {
        $this->registerPolicies();

        $gate->before(function($user)
        {
            $permissoes = Permissoes::all();

            foreach ($permissoes as $permissao)
            {

                Gate::define($permissao->permissao_rota, function ($user) use ($permissao) {

                    return $user->possuiPermissao($permissao);
                });
            }

            if ($user->superUsuario()){
                return true;
            }

        });
    }
}
