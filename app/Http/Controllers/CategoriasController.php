<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Prioridades;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoriasController extends Controller
{

    public function index(Request $request)
    {
        $prioridades    = Prioridades::get();
        $categorias     = new Categorias();
        $categorias     = $categorias->join('pro_prioridades', 'pro_categorias.prioridade_codigo', '=', 'pro_prioridades.prioridade_codigo');

        if (isset($request->filtroDescricao) && $request->filtroDescricao != '') {
            $categorias = $categorias->where('categoria_descricao', 'like', '%' . $request->filtroDescricao . '%');
        }

        if (isset($request->filtroPrioridade) && $request->filtroPrioridade != '._.') {
            $categorias = $categorias->where('pro_categorias.prioridade_codigo', $request->filtroPrioridade);
        }

        $categorias     = $categorias->paginate(env('QTD_PAGINACAO'))->appends([
            'categoria_descricao' => $request->filtroDescricao,
            'prioridade_codigo' => $request->filtroPrioridade
        ]);


        if ($request->ajax()) {

            $retorno = [
                'dados' => $this->montaTabela($categorias),
                'links' => $categorias
            ];

            return response()->json($retorno);
        }

        return view('categorias.index', compact('prioridades'));
    }

    public function create()
    {
        $prioridades = Prioridades::pluck('prioridade_descricao', 'prioridade_codigo');

        return view('categorias.create', compact('prioridades'));
    }

    public function store(Request $request)
    {
        try {

            $categoria  = Categorias::create($request->all());

            $response   = [
                'message' => env('REGISTRO_CADASTRADO'),
                'data'    => $categoria->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('categorias.index')->with('message', $response['message']);

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
        $prioridades = Prioridades::pluck('prioridade_descricao', 'prioridade_codigo');
        $categoria   = Categorias::where('categoria_codigo', $id)->first();

        return view('categorias.edit', compact('categoria', 'prioridades'));
    }

    public function update(Request $request, $id)
    {
        try {

            $update     = [
                'categoria_descricao' => $request->categoria_descricao,
                'prioridade_codigo' => $request->prioridade_codigo
            ];

            $categoria  = Categorias::where('categoria_codigo', $id)->update($update);

            $response   = [
                'message' => env('REGISTRO_ATUALIZADO'),
                'data'    => $categoria,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('categorias.index')->with('message', $response['message']);

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
        $deleted = Categorias::find($id)->delete();

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
                $html .= '<td>' . $registros[$i]['categoria_codigo'] . '</td>';
                $html .= '<td>' . $registros[$i]['categoria_descricao'] . '</td>';
                $html .= '<td>' . $registros[$i]['prioridade_descricao'] . '</td>';

                if (Gate::allows('categorias.edit')) {
                    $html .= '<td><a href="'.route('categorias.edit', $registros[$i]['categoria_codigo']).'" class="btn btn-warning btn-sm" style="width: 40px;"><i class="fa fa-edit"></i></a ></td>';
                }

                if (Gate::allows('categorias.destroy')) {
                    $html .= '<td>';
                    $html .= '<form method="POST" action="'.route( 'categorias.destroy', $registros[$i]['categoria_codigo']).'">';
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
