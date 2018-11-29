<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Prioridades;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $prioridades = Prioridades::get();

        $categorias = new Categorias();
        $categorias = $categorias->join('pro_prioridades', 'pro_categorias.prioridade_codigo', '=', 'pro_prioridades.prioridade_codigo');

        if($request->has('filtroDescricao') && $request->filtroDescricao != ''){
            $categorias = $categorias->where('categoria_descricao', 'like',  '%'.$request->filtroDescricao.'%');
        }

        if($request->has('filtroPrioridade') && $request->filtroPrioridade != '._.'){
            $categorias = $categorias->where('prioridade_codigo', $request->filtroPrioridade);
        }

        $categorias = $categorias->paginate(env('QTD_PAGINACAO'))->appends([
            'categoria_descricao' => $request->filtroDescricao,
            'prioridade_codigo' => $request->filtroPrioridade
        ]);


        if ($request->wantsJson()){
            return response()->json($categorias);
        }

        return view('categorias.index', compact('prioridades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
