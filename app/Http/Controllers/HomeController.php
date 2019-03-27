<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function getGraficos(Request $request){

        /* QTD. ABERTO X QTD.FECHADO NO MÊS*/
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('pro_helpdesk_status.status_descricao, pro_helpdesk_status.status_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('pro_helpdesk_status', 'pro_helpdesk_status.status_codigo', '=', 'pro_helpdesk.status_codigo');
        $helpdesk = $helpdesk->whereRaw('EXTRACT(MONTH FROM pro_helpdesk.created_at) = ?', date('m'));

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->groupBy('pro_helpdesk_status.status_codigo');
        $helpdesk = $helpdesk->orderBy('pro_helpdesk_status.status_codigo');
        $helpdesk = $helpdesk->get();

        $labels = [];
        $values = [];
        $colors = [];

        for ($i = 0; $i < sizeof($helpdesk); $i++){
            array_push($labels, $helpdesk[$i]->status_descricao);
            array_push($values, $helpdesk[$i]->quantidade);
            array_push($colors, $helpdesk[$i]->status_cor);
        }

        $resposta_chamados_aberto_fechados_mes = [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ];

        $resposta['abertos_fechados_mes'] = $resposta_chamados_aberto_fechados_mes;

        /* QTD. ABERTO POR DEPARTAMENTO */
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('departamento_descricao, empresa_fantasia, departamento_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('sys_credencial', 'pro_helpdesk.credencial_codigo_cliente', '=', 'sys_credencial.credencial_codigo');
        $helpdesk = $helpdesk->join('pro_departamentos', 'pro_departamentos.departamento_codigo', '=', 'sys_credencial.departamento_codigo');
        $helpdesk = $helpdesk->join('pro_empresas', 'pro_empresas.empresa_codigo', '=', 'pro_departamentos.empresa_codigo');
        $helpdesk = $helpdesk->whereRaw('EXTRACT(MONTH FROM pro_helpdesk.created_at) = ?', date('m'));

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->groupBy('pro_departamentos.departamento_descricao');
        $helpdesk = $helpdesk->orderBy('pro_departamentos.departamento_descricao');
        $helpdesk = $helpdesk->get();

        $datasets = [];

        for ($i = 0; $i < sizeof($helpdesk); $i++){

            $dataset = [
                "label" => $helpdesk[$i]->empresa_fantasia.' - '.$helpdesk[$i]->departamento_descricao,
                "type" => 'bar',
                "backgroundColor" => $helpdesk[$i]->departamento_cor,
                "stack" => 'Stack '.$i,
                "data" => array_fill(0, 1, $helpdesk[$i]->quantidade)
            ];

            array_push($datasets, $dataset);
        }

        $resposta_chamados_aberto_departamentos_mes = [
            'labels' => $labels,
            'datasets' => $datasets
        ];

        $resposta['abertos_departamentos_mes'] = $resposta_chamados_aberto_departamentos_mes;


        /* QTD. ABERTO POR EMPRESA */
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('empresa_fantasia, pro_empresas.empresa_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('sys_credencial', 'pro_helpdesk.credencial_codigo_cliente', '=', 'sys_credencial.credencial_codigo');
        $helpdesk = $helpdesk->join('pro_departamentos', 'pro_departamentos.departamento_codigo', '=', 'sys_credencial.departamento_codigo');
        $helpdesk = $helpdesk->join('pro_empresas', 'pro_empresas.empresa_codigo', '=', 'pro_departamentos.empresa_codigo');
        $helpdesk = $helpdesk->whereRaw('EXTRACT(MONTH FROM pro_helpdesk.created_at) = ?', date('m'));

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->groupBy('pro_empresas.empresa_fantasia');
        $helpdesk = $helpdesk->orderBy('pro_empresas.empresa_fantasia');
        $helpdesk = $helpdesk->get();

        $datasets = [];

        for ($i = 0; $i < sizeof($helpdesk); $i++){

            $dataset = [
                "label" => $helpdesk[$i]->empresa_fantasia,
                "type" => 'bar',
                "backgroundColor" => $helpdesk[$i]->empresa_cor,
                "stack" => 'Stack '.$i,
                "data" => array_fill(0, 1, $helpdesk[$i]->quantidade)
            ];

            array_push($datasets, $dataset);
        }

        $resposta_chamados_aberto_empresas_mes = [
            'labels' => $labels,
            'datasets' => $datasets
        ];

        $resposta['abertos_empresas_mes'] = $resposta_chamados_aberto_empresas_mes;


//dd(response()->json($resposta));
        return response()->json($resposta);
    }
}
