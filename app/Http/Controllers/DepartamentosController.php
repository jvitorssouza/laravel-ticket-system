<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\Empresas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DepartamentosController extends Controller
{

    public function index(Request $request)
    {
        $empresas    = Empresas::get();

        $departamentos     = new Departamentos();
        $departamentos     = $departamentos->join('pro_empresas', 'pro_departamentos.empresa_codigo', '=', 'pro_empresas.empresa_codigo');

        if (isset($request->filtroDescricao) && $request->filtroDescricao != '') {
            $departamentos = $departamentos->where('departamento_descricao', 'like', '%' . $request->filtroDescricao . '%');
        }

        if (isset($request->filtroPrioridade) && $request->filtroPrioridade != '._.') {
            $departamentos = $departamentos->where('pro_departamentos.empresa_codigo', $request->filtroPrioridade);
        }

        $departamentos     = $departamentos->paginate(env('QTD_PAGINACAO'))->appends([
            'departamento_descricao' => $request->filtroDescricao,
            'empresa_codigo' => $request->filtroPrioridade
        ]);

        if ($request->ajax()) {

            $retorno = [
                'dados' => $this->montaTabela($departamentos),
                'links' => $departamentos
            ];

            return response()->json($retorno);
        }

        return view('departamentos.index', compact('empresas'));
    }

    public function create()
    {
        $empresas = Empresas::pluck('empresa_rzsocial', 'empresa_codigo');

        return view('departamentos.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        try {

            $departamento  = Departamentos::create($request->all());

            $response   = [
                'message' => env('REGISTRO_CADASTRADO'),
                'data'    => $departamento->toArray(),
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
                'empresa_codigo' => $request->empresa_codigo,
                'departamento_cor' => $request->departamento_cor,
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
                $html .= '<td>' . $registros[$i]['departamento_codigo'] . '</td>';
                $html .= '<td>' . $registros[$i]['departamento_descricao'] . '</td>';
                $html .= '<td>' . $registros[$i]['empresa_rzsocial'] . '</td>';

                if (Gate::allows('departamentos.edit')) {
                    $html .= '<td><a href="'.route('departamentos.edit', $registros[$i]['departamento_codigo']).'" class="btn btn-warning btn-sm" style="width: 40px;"><i class="fa fa-edit"></i></a ></td>';
                }

                if (Gate::allows('departamentos.destroy')) {
                    $html .= '<td>';
                    $html .= '<form method="POST" action="'.route( 'departamentos.destroy', $registros[$i]['departamento_codigo']).'">';
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
