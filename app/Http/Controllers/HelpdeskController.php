<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Helpdesk;
use App\Models\HelpdeskAnexos;
use App\Models\HelpdeskInteracoes;
use App\Models\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class HelpdeskController extends Controller
{
    public function index(Request $request)
    {

        $helpdesk = new Helpdesk();

        $helpdesk = $helpdesk->select(
            'pro_helpdesk.*', 'credencial_cliente.credencial_nome AS nome_cliente',
            'credencial_atendente.credencial_nome AS nome_atendente', 'pro_helpdesk_status.status_descricao', 'pro_helpdesk_status.status_classe',
            'pro_categorias.categoria_descricao', 'pro_prioridades.prioridade_grau'
        );

        $helpdesk = $helpdesk->join('pro_helpdesk_status', 'pro_helpdesk.status_codigo', '=', 'pro_helpdesk_status.status_codigo');
        $helpdesk = $helpdesk->join('pro_categorias', 'pro_helpdesk.categoria_codigo', '=', 'pro_categorias.categoria_codigo');
        $helpdesk = $helpdesk->join('pro_prioridades', 'pro_categorias.prioridade_codigo', '=', 'pro_prioridades.prioridade_codigo');
        $helpdesk = $helpdesk->leftJoin('sys_credencial AS credencial_cliente', 'pro_helpdesk.credencial_codigo_cliente', '=', 'credencial_cliente.credencial_codigo');
        $helpdesk = $helpdesk->leftJoin('sys_credencial AS credencial_atendente', 'pro_helpdesk.credencial_codigo_atendente', '=', 'credencial_atendente.credencial_codigo');

        if (isset($request->filtroNumero) && $request->filtroNumero != '') {
            $helpdesk = $helpdesk->where('pro_helpdesk.helpdesk_codigo', '=', $request->filtroNumero);
        }

        if (isset($request->filtroTitulo) && $request->filtroTitulo != '') {
            $helpdesk = $helpdesk->where('pro_helpdesk.helpdesk_titulo', 'like', '%' . $request->filtroTitulo . '%');
        }

        if (isset($request->filtroCategoria) && $request->filtroCategoria != '._.') {
            $helpdesk = $helpdesk->where('pro_helpdesk.categoria_codigo', $request->filtroCategoria);
        }

        if (isset($request->filtroStatus) && $request->filtroStatus != '._.'){
            $helpdesk = $helpdesk->where('pro_helpdesk.status_codigo', '=', $request->filtroStatus);
        }else{
            $helpdesk = $helpdesk->where('pro_helpdesk.status_codigo', '<>', 4);
        }

        if (isset($request->filtroDataIni) && $request->filtroDataIni != '') {
            $helpdesk = $helpdesk->where('pro_helpdesk.created_at', '>=', $request->filtroDataIni);
        }

        if (isset($request->filtroDataFim) && $request->filtroDataFim != '') {
            $helpdesk = $helpdesk->where('pro_helpdesk.created_at', '<=', $request->filtroDataFim);
        }

        if (isset($request->filtroDataFim) && $request->filtroDataFim != '') {
            $helpdesk = $helpdesk->where('pro_helpdesk.created_at', '<=', $request->filtroDataFim);
        }

        if (isset($request->filtroCliente) && $request->filtroCliente != '._.') {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', $request->filtroCliente);
        }

        if (isset($request->filtroAtendente) && $request->filtroAtendente != '._.') {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_atendente', '=', $request->filtroAtendente);
        }

        if (!Gate::allows('helpdesk.ver_todos_chamados')) {
            $helpdesk = $helpdesk->where('pro_helpdesk.credencial_codigo_cliente', '=', Auth::user()->credencial_codigo);
        }

        $helpdesk = $helpdesk->orderBy('pro_prioridades.prioridade_grau', 'DESC');
        $helpdesk = $helpdesk->orderBy('pro_helpdesk.created_at', 'ASC');

        $helpdesk = $helpdesk->paginate(env('QTD_PAGINACAO'))->appends([
            'helpdesk_codigo' => $request->filtroNumero,
            'helpdesk_titulo' => $request->filtroTitulo,
            'categoria_codigo' => $request->filtroCategoria,
            'status_codigo' => $request->filtroStatus
        ]);

        $categorias = Categorias::get();
        $status     = Status::get();
        $clientes   = User::get();
        $atendentes = User::whereIn('perfil_codigo', [1,2])->get();

        if ($request->ajax()) {

            $retorno = [
                'dados' => $this->montaTabela($helpdesk),
                'links' => $helpdesk
            ];

            return response()->json($retorno);
        }

        return view('helpdesk.index', compact('categorias', 'status', 'clientes', 'atendentes'));
    }

    public function create()
    {
        $categorias = Categorias::pluck('categoria_descricao', 'categoria_codigo');

        return view('helpdesk.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        try {

            $request['status_codigo'] = 1;
            $request['credencial_codigo_cliente'] = Auth::user()->credencial_codigo;

            $helpdesk = Helpdesk::create($request->all());

            if (isset($request->fotos)){
                for ($i = 0; $i < sizeof($request->fotos); $i++){
                    if ($request->fotos[$i] != null){
                        $file = $request->fotos[$i];

                        $file_name = $file->getClientOriginalName();

                        $file_path = storage_path('app/public/helpdesk/'.$helpdesk->helpdesk_codigo);

                        $helpdesk_anexos = [
                            'anexos_caminho' => $helpdesk->helpdesk_codigo.'/'.$file_name,
                            'helpdesk_codigo' => $helpdesk->helpdesk_codigo
                        ];

                        $anexos    = HelpdeskAnexos::create($helpdesk_anexos);

                        $file->move($file_path, $file_name);
                    }
                }
            }

            $response = [
                'message' => 'Chamado aberto com sucesso!',
                'data'    => $helpdesk->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('helpdesk.index')->with('message', $response['message']);

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
        $categorias = Categorias::pluck('categoria_descricao', 'categoria_codigo');
        $helpdesk   = Helpdesk::where('helpdesk_codigo', $id)->first();
        $anexos     = HelpdeskAnexos::where('helpdesk_codigo', $id)->get();
        $interacoes = HelpdeskInteracoes::where('helpdesk_codigo', $id)
                      ->leftJoin('sys_credencial', 'sys_credencial.credencial_codigo', '=', 'pro_helpdesk_interacoes.credencial_codigo')
                      ->orderBy('pro_helpdesk_interacoes.created_at', 'Desc')
                      ->get();

        return view('helpdesk.show', compact('helpdesk', 'categorias', 'anexos', 'interacoes'));
    }

    public function edit($id)
    {
        $categorias = Categorias::pluck('categoria_descricao', 'categoria_codigo');
        $helpdesk   = Helpdesk::where('helpdesk_codigo', $id)->first();
        $imagens    = HelpdeskAnexos::where('helpdesk_codigo', $id)->get();


        if ($helpdesk->status_codigo == 4){
            return redirect('helpdesk')->withErrors('Não é permitido editar um chamado finalizado')->withInput();
        }

        return view('helpdesk.edit', compact('helpdesk', 'categorias', 'imagens'));
    }

    public function update(Request $request, $id)
    {
        try {

            $update    = [
                'categoria_codigo' => $request->categoria_codigo,
                'helpdesk_titulo' => $request->helpdesk_titulo,
                'helpdesk_detalhes' => $request->helpdesk_detalhes
            ];

            $categoria = Helpdesk::where('helpdesk_codigo', $id)->update($update);

            $response  = [
                'message' => env('REGISTRO_ATUALIZADO'),
                'data'    => $categoria,
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            if (isset($request->fotos)){
                for ($i = 0; $i < sizeof($request->fotos); $i++){
                    if ($request->fotos[$i] != null){
                        $file = $request->fotos[$i];

                        $file_name = $file->getClientOriginalName();

                        $file_path = storage_path('app/public/helpdesk/'.$id);

                        $helpdesk_anexos = [
                            'anexos_caminho' => $id.'/'.$file_name,
                            'helpdesk_codigo' => $id
                        ];

                        $anexos    = HelpdeskAnexos::create($helpdesk_anexos);

                        $file->move($file_path, $file_name);
                    }
                }
            }

            if (isset($request->fotos_remover)){
                for ($i = 0; $i < sizeof($request->fotos_remover); $i++){
                    $delete = HelpdeskAnexos::find($request->fotos_remover[$i])->delete();
                }
            }

            return redirect()->route('helpdesk.index')->with('message', $response['message']);

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
        $deleted = Helpdesk::find($id)->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'message' => env('REGISTRO_DELETADO'),
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Chamado deletado com sucesso!');
    }

    public function montaTabela($registros)
    {

        $html = '';

        if (sizeof($registros) > 0) {
            for ($i = 0; $i < sizeof($registros); $i++) {
                $html .= '<tr>';
                $html .= '<td>' . $registros[$i]['helpdesk_codigo'] . '</td>';
                $html .= '<td>' . Carbon::parse($registros[$i]['created_at'])->format('d/m/Y') . '</td>';
//                $html .= '<td>' . $registros[$i]['categoria_descricao'] . '</td>';
                $html .= '<td>' . $registros[$i]['helpdesk_titulo'] . '</td>';
                $html .= '<td>' . $registros[$i]['nome_cliente'] . '</td>';
                $html .= '<td>' . $registros[$i]['nome_atendente'] . '</td>';
                $html .= '<td><span class="badge '.$registros[$i]['status_classe'].'">' . $registros[$i]['status_descricao'] . '</span></td>';

                if (Gate::allows('helpdesk.edit') && $registros[$i]['status_codigo'] != 4) {
                    $html .= '<td><a href="'.route('helpdesk.edit', $registros[$i]['helpdesk_codigo']).'" class="btn btn-warning btn-sm" style="width: 40px;"><i class="fa fa-edit"></i></a ></td>';
                }

                if (Gate::allows('helpdesk.destroy') && $registros[$i]['status_codigo'] != 4) {
                    $html .= '<td>';
                    $html .= '<form method="POST" action="'.route( 'helpdesk.destroy', $registros[$i]['helpdesk_codigo']).'">';
                    $html .= csrf_field();
                    $html .= method_field('DELETE');
                    $html .= '<button type="submit" class="btn btn-danger btn-sm btn-delete" style="width: 40px;"> <i class="fa fa-trash"></i> </button>';
                    $html .= '</form>';
                    $html .= '</td>';
                }

                if (Gate::allows('helpdesk.show')) {
                    $html .= '<td><a href="'.route('helpdesk.show', $registros[$i]['helpdesk_codigo']).'" class="btn btn-primary btn-sm" style="width: 40px;"><i class="fas fa-eye"></i></a ></td>';
                }

                $html .= '</tr>';
            }
        } else {
            $html .= '<tr>';
            $html .= '<td colspan="100">Nenhum registro a exibir</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public function iniciarAtendimento($id){
        try {

            $update   = [
                'status_codigo' => 2,
                'credencial_codigo_atendente' => Auth::user()->credencial_codigo
            ];

            $insere_interacao   = [
                'interacoes_descricao' => 'Mudança de situação para em atendimento.',
                'helpdesk_codigo' => $id,
                'credencial_codigo' => Auth::user()->credencial_codigo,
            ];

            $interacao = HelpdeskInteracoes::create($insere_interacao);

            $helpdesk = Helpdesk::where('helpdesk_codigo', $id)->update($update);

            $response = [
                'message' => 'Atendimento iniciado com sucesso!',
                'data'    => $helpdesk,
            ];

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function finalizarAtendimento($id){
        try {

            $update   = [
                'status_codigo' => 4
            ];

            $helpdesk = Helpdesk::where('helpdesk_codigo', $id)->update($update);

            $insere_interacao   = [
                'interacoes_descricao' => 'Mudança de situação para finalizado.',
                'helpdesk_codigo' => $id,
                'credencial_codigo' => Auth::user()->credencial_codigo,
            ];

            $interacao = HelpdeskInteracoes::create($insere_interacao);

            $response = [
                'message' => 'Atendimento finalizado com sucesso!',
                'data'    => $helpdesk,
            ];

            return redirect()->route('helpdesk.index')->with('message', $response['message']);

        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function reabrirAtendimento($id){
        try {

            $update   = [
                'status_codigo' => 1
            ];

            $helpdesk = Helpdesk::where('helpdesk_codigo', $id)->update($update);

            $insere_interacao   = [
                'interacoes_descricao' => 'Atendimento Reaberto.',
                'helpdesk_codigo' => $id,
                'credencial_codigo' => Auth::user()->credencial_codigo,
            ];

            $interacao = HelpdeskInteracoes::create($insere_interacao);

            $response = [
                'message' => 'Atendimento reaberto com sucesso!',
                'data'    => $helpdesk,
            ];

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function baixarAppRemoto(){
        return Storage::download('suporte/SuporteRemoto.exe');
    }

    public function inserirInteracao(Request $request){
        try {

            $interacao = HelpdeskInteracoes::create($request->all());

            $response = [
                'message' => 'Interação inserida com sucesso!',
                'data'    => $interacao,
            ];

            return redirect()->back()->with('message', $response['message']);

        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
