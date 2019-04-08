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
        // QTD. CHAMADOS ABERTOS
        $qtd_helpdesk_aberto = Helpdesk::where('status_codigo', '<>', '4');

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $qtd_helpdesk_aberto = $qtd_helpdesk_aberto->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $qtd_helpdesk_aberto = count($qtd_helpdesk_aberto->get());

        //QTD. CHAMADOS AGUARDANDO ATENDIMENTO
        $qtd_helpdesk_aguardando = Helpdesk::where('status_codigo', '=', '1');

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $qtd_helpdesk_aguardando = $qtd_helpdesk_aguardando->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $qtd_helpdesk_aguardando = count($qtd_helpdesk_aguardando->get());

        //QTD. CHAMADOS EM ATENDIMENTO
        $qtd_helpdesk_atendimento = Helpdesk::where('status_codigo', '=', '2');

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $qtd_helpdesk_atendimento = $qtd_helpdesk_atendimento->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $qtd_helpdesk_atendimento = count($qtd_helpdesk_atendimento->get());

        return view('home', compact('qtd_helpdesk_aberto', 'qtd_helpdesk_aguardando', 'qtd_helpdesk_atendimento'));
    }

    public function getGraficos(Request $request){

        /* QTD. ABERTO X STATUS*/
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('pro_helpdesk_status.status_descricao, pro_helpdesk_status.status_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('pro_helpdesk_status', 'pro_helpdesk_status.status_codigo', '=', 'pro_helpdesk.status_codigo');

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->where('pro_helpdesk.status_codigo', '<>', '4');
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

        $resposta_chamados_aberto_status_mes = [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ];

        $resposta['abertos_status_mes'] = $resposta_chamados_aberto_status_mes;

        /* QTD. ABERTO X CATEGORIA*/
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('pro_categorias.categoria_descricao, pro_categorias.categoria_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('pro_categorias', 'pro_categorias.categoria_codigo', '=', 'pro_helpdesk.categoria_codigo');

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->groupBy('pro_helpdesk.categoria_codigo');
        $helpdesk = $helpdesk->orderBy('pro_helpdesk.categoria_codigo');
        $helpdesk = $helpdesk->get();

        $labels = [];
        $values = [];
        $colors = [];

        for ($i = 0; $i < sizeof($helpdesk); $i++){
            array_push($labels, $helpdesk[$i]->categoria_descricao);
            array_push($values, $helpdesk[$i]->quantidade);
            array_push($colors, $helpdesk[$i]->categoria_cor);
        }

        $resposta_chamados_aberto_categorias_mes = [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ];

        $resposta['abertos_categorias_mes'] = $resposta_chamados_aberto_categorias_mes;

        /* QTD. ABERTO POR DEPARTAMENTO */
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('departamento_descricao, empresa_fantasia, departamento_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('sys_credencial', 'pro_helpdesk.credencial_codigo_cliente', '=', 'sys_credencial.credencial_codigo');
        $helpdesk = $helpdesk->join('pro_departamentos', 'pro_departamentos.departamento_codigo', '=', 'sys_credencial.departamento_codigo');
        $helpdesk = $helpdesk->join('pro_empresas', 'pro_empresas.empresa_codigo', '=', 'pro_departamentos.empresa_codigo');

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


        /* QTD. ABERTO POR FILIAL */
        $helpdesk = new Helpdesk();
        $helpdesk = $helpdesk->selectRaw(DB::raw('departamento_descricao, empresa_fantasia, departamento_cor, count(*) AS quantidade'));
        $helpdesk = $helpdesk->join('sys_credencial', 'pro_helpdesk.credencial_codigo_cliente', '=', 'sys_credencial.credencial_codigo');
        $helpdesk = $helpdesk->join('pro_departamentos', 'pro_departamentos.departamento_codigo', '=', 'sys_credencial.departamento_codigo');
        $helpdesk = $helpdesk->join('pro_empresas', 'pro_empresas.empresa_codigo', '=', 'pro_departamentos.empresa_codigo');

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


        return response()->json($resposta);
    }
}
