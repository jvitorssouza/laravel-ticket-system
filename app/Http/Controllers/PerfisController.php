<?php

namespace App\Http\Controllers;

use App\Models\Perfis;
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
        return view('perfis.create');
    }

    public function store(Request $request)
    {
        try {

            $perfil  = Perfis::create($request->all());

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
        $empresas = Empresas::pluck('empresa_rzsocial', 'empresa_codigo');
        $departamento   = Departamentos::where('departamento_codigo', $id)->first();

        return view('departamentos.edit', compact('departamento', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        try {

            $update     = [
                'departamento_descricao' => $request->departamento_descricao,
                'empresa_codigo' => $request->empresa_codigo
            ];

            $departamento  = Departamentos::where('departamento_codigo', $id)->update($update);

            $response   = [
                'message' => env('REGISTRO_ATUALIZADO'),
                'data'    => $departamento,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('departamentos.index')->with('message', $response['message']);

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
        $deleted = Departamentos::find($id)->delete();

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
