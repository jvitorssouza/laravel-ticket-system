<?php
namespace  App\Http\ViewComposers;

use App\Models\SistemaMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


class GlobalComposer
{

    public function compose(View $view)
    {
        $route = Route::current();
        $module_name = $this->getModuleName($route);
        $action_name = $this->getActionName($route);

        $rota_atual = $module_name.'.'.$action_name;
        $view->with('module_name',$module_name);
        $view->with('action_name',$action_name);
        $view->with('rota_atual',$rota_atual);
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
