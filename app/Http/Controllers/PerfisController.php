<?php

namespace App\Http\Controllers;

use App\Models\Perfis;
use App\Models\PerfisPermissoes;
use App\Models\Permissoes;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PerfisController extends Controller
{

    public function index(Request $request)
    {
        $perfis     = new Perfis();

        if (isset($request->filtroDescricao) && $request->filtroDescricao != '') {
            $perfis = $perfis->where('perfil_descricao', 'like', '%' . $request->filtroDescricao . '%');
        }

        $perfis     = $perfis->paginate(env('QTD_PAGINACAO'))->appends([
            'departamento_descricao' => $request->filtroDescricao,
            'empresa_codigo' => $request->filtroPrioridade
        ]);

        if ($request->ajax()) {

            $retorno = [
                'dados' => $this->montaTabela($perfis),
                'links' => $perfis
            ];

            return response()->json($retorno);
        }

        return view('perfis.index');
    }

    public function create()
    {
        $permissoes   = Permissoes::all();
        $selecionadas = [];
        return view('perfis.create', compact('permissoes', 'selecionadas'));
    }

    public function store(Request $request)
    {
        try {

            $perfil  = Perfis::create($request->all());

            if (sizeof($request->permissoes) > 0){
                for ($i = 0; $i < sizeof($request->permissoes); $i++){
                    $dados = [
                        'perfil_codigo' => $perfil['perfil_codigo'],
                        'permissao_codigo' => $request->permissoes[$i]
                    ];

                    PerfisPermissoes::create($dados);
                }
            }

            $response   = [
                'message' => env('REGISTRO_CADASTRADO'),
                'data'    => $perfil->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('perfilacesso.index')->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function edit($id)
    {
        $perfil       = Perfis::where('perfil_codigo', $id)->first();
        $permissoes   = Permissoes::all();
        $permissoes_selecionadas = PerfisPermissoes::select('permissao_codigo')->where('perfil_codigo', $id)->get();

        $selecionadas = [];

        for ($i = 0; $i < sizeof($permissoes_selecionadas); $i++){
            if (!in_array($permissoes_selecionadas[$i]->permissao_codigo, $selecionadas)){
                array_push($selecionadas, $permissoes_selecionadas[$i]->permissao_codigo);
            }
        }

        return view('perfis.edit', compact('perfil','permissoes', 'selecionadas'));
    }

    public function update(Request $request, $id)
    {
        try {

            $update     = [
                'perfil_descricao' => $request->perfil_descricao
            ];

            $perfil  = Perfis::where('perfil_codigo', $id)->update($update);


            /* VERIFICA PERMISSOES QUE JÁ ESTAVAM SELECIONADAS */

            $permissoes_selecionadas = PerfisPermissoes::select('permissao_codigo')->where('perfil_codigo', $id)->get();

            $selecionadas = [];

            for ($i = 0; $i < sizeof($permissoes_selecionadas); $i++){
                if (!in_array($permissoes_selecionadas[$i]->permissao_codigo, $selecionadas)){
                    array_push($selecionadas, $permissoes_selecionadas[$i]->permissao_codigo);
                }
            }

            /* ADICIONA OU REMOVE PERMISSOES */
            $adicionar = [];
            $remover   = [];

            for ($i = 0; $i < sizeof($request->permissoes); $i++){
                if (!in_array($request->permissoes[$i], $selecionadas)){
                    array_push($adicionar, $request->permissoes[$i]);
                }
            }

            for ($i = 0; $i < sizeof($selecionadas); $i++){
                if (!in_array($selecionadas[$i], $request->permissoes)){
                    array_push($remover, $selecionadas[$i]);
                }
            }

            // ADICIONA OS PERFIS
            for ($i = 0; $i < sizeof($adicionar); $i++){
                $dados = [
                    'perfil_codigo' => $id,
                    'permissao_codigo' => $adicionar[$i]
                ];

                $adiciona = PerfisPermissoes::create($dados);
            }

            $remove = PerfisPermissoes::whereIn('permissao_codigo', $remover)->delete();

            $response   = [
                'message' => env('REGISTRO_ATUALIZADO'),
                'data'    => $perfil,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('perfilacesso.index')->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        $remover_permissoes = PerfisPermissoes::where('perfil_codigo', $id)->delete();
        $deleted = Perfis::find($id)->delete();

        if (request()->wantsJson()) {

            return response()->json([
                'message' => env('REGISTRO_DELETADO'),
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', env('REGISTRO_DELETADO'));
    }

    public function montaTabela($registros)
    {
        $html = '';

        if (sizeof($registros) > 0) {
            for ($i = 0; $i < sizeof($registros); $i++) {
                $html .= '<tr>';
                $html .= '<td>' . $registros[$i]['perfil_codigo'] . '</td>';
                $html .= '<td>' . $registros[$i]['perfil_descricao'] . '</td>';

                if (Gate::allows('perfilacesso.edit')) {
                    $html .= '<td><a href="'.route('perfilacesso.edit', $registros[$i]['perfil_codigo']).'" class="btn btn-warning btn-sm" style="width: 40px;"><i class="fa fa-edit"></i></a ></td>';
                }

                if (Gate::allows('perfilacesso.destroy')) {
                    $html .= '<td>';
                    $html .= '<form method="POST" action="'.route( 'perfilacesso.destroy', $registros[$i]['perfil_codigo']).'">';
                    $html .= csrf_field();
                    $html .= method_field('DELETE');
                    $html .= '<button type="submit" class="btn btn-danger btn-sm btn-delete" style="width: 40px;"> <i class="fa fa-trash"></i> </button>';
                    $html .= '</form>';
                    $html .= '</td>';
                }

                $html .= '</tr>';
            }
        } else {
            $html .= '<tr>';
            $html .= '<td colspan="5">Nenhum registro a exibir</td>';
            $html .= '</tr>';
        }

        return $html;
    }

}
