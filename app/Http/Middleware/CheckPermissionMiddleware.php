<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = Route::current();
        $module_name = $this->getModuleName($route);
        $action_name = $this->getActionName($route);

        $rota_atual = $module_name.'.'.$action_name;

        if (Gate::allows($rota_atual)){
            return $next($request);
        }else{
            if ($action_name == 'store'){
                if (Gate::allows($module_name.'.'.'create')){
                    return $next($request);
                }
            }elseif($action_name == 'update'){
                if (Gate::allows($module_name.'.'.'edit')){
                    return $next($request);
                }
            }elseif($action_name == 'iniciar_chamado' || $action_name == 'finalizar_chamado'){
                if (Gate::allows('helpdesk.atender_chamado')){
                    return $next($request);
                }
            }else{
                abort(403);
            }
        }

    }

    protected function getModuleName($route)
    {
        if(Auth::user())
        {
            if (!is_null($route)){
                list($name,$action) = explode('.',$route->getName());
                if($name)
                {
                    return $name;
                }
            }
        }
    }

    protected function getActionName($route)
    {
        if(Auth::user())
        {
            if (!is_null($route)){
                list($name,$action) = explode('.',$route->getName());
                if($action)
                {
                    return $action;
                }
            }
        }
    }

}
