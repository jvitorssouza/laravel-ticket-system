<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmpresasController extends Controller
{

    public function index(Request $request)
    {
        $empresas   = new Empresas();

        if (isset($request->filtroCpfCnpj) && $request->filtroCpfCnpj != '') {
            $empresas = $empresas->where('pro_empresas.empresa_cnpj', $request->filtroCpfCnpj);
        }

        if (isset($request->filtroRzSocialFantasia) && $request->filtroRzSocialFantasia != '') {
            $empresas = $empresas->where('pro_empresas.empresa_rzsocial', 'like', '%'. $request->filtroRzSocialFantasia . '%')
                                 ->orWhere('pro_empresas.empresa_fantasia', 'like', '%'. $request->filtroRzSocialFantasia . '%');
        }

        $empresas   = $empresas->paginate(env('QTD_PAGINACAO'))->appends([
            'empresa_cnpj' => $request->filtroCpfCnpj,
            'empresa_rzsocial' => $request->filtroRzSocialFantasia,
            'empresa_fantasia' => $request->filtroRzSocialFantasia
        ]);

        if ($request->ajax()) {

            $retorno = [
                'dados' => $this->montaTabela($empresas),
                'links' => $empresas
            ];

            return response()->json($retorno);
        }

        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        try {

            $empresa  = Empresas::create($request->all());

            $response   = [
                'message' => env('REGISTRO_CADASTRADO'),
                'data'    => $empresa->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('empresas.index')->with('message', $response['message']);

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $empresa   = Empresas::where('empresa_codigo', $id)->first();
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        try {

            $update     = [
                'empresa_rzsocial' => $request->empresa_rzsocial,
                'empresa_fantasia' => $request->empresa_fantasia,
                'empresa_cnpj' => $request->empresa_cnpj,
                'empresa_logradouro' => $request->empresa_logradouro,
                'empresa_numero' => $request->empresa_numero,
                'empresa_bairro' => $request->empresa_bairro,
                'empresa_cidade' => $request->empresa_cidade,
                'empresa_uf' => $request->empresa_uf,
                'empresa_cep' => $request->empresa_cep
            ];

            $empresa  = Empresas::where('empresa_codigo', $id)->update($update);

            $response   = [
                'message' => env('REGISTRO_ATUALIZADO'),
                'data'    => $empresa,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('empresas.index')->with('message', $response['message']);

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
        $deleted = Empresas::find($id)->delete();

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
                $html .= '<td>' . $registros[$i]['empresa_codigo'] . '</td>';
                $html .= '<td>' . $registros[$i]['empresa_rzsocial'] . '</td>';
                $html .= '<td>' . $registros[$i]['empresa_fantasia'] . '</td>';
                $html .= '<td>';
                $html .=     $registros[$i]['empresa_logradouro'] . ', ';
                $html .=     $registros[$i]['empresa_numero']     . ', ';
                $html .=     $registros[$i]['empresa_bairro']     . ', ';
                $html .=     $registros[$i]['empresa_cidade']     . ' - ';
                $html .=     strtoupper($registros[$i]['empresa_uf']);
                $html .= '</td>';

                if (Gate::allows('empresas.edit')) {
                    $html .= '<td><a href="'.route('empresas.edit', $registros[$i]['empresa_codigo']).'" class="btn btn-warning btn-sm" style="width: 40px;"><i class="fa fa-edit"></i></a ></td>';
                }

                if (Gate::allows('empresas.destroy')) {
                    $html .= '<td>';
                    $html .= '<form method="POST" action="'.route( 'empresas.destroy', $registros[$i]['empresa_codigo']).'">';
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
            $html .= '<td colspan="10">Nenhum registro a exibir</td>';
            $html .= '</tr>';
        }

        return $html;
    }
}
