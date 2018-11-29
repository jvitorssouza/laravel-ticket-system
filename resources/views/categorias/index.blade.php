@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Categorias de Chamados
@endsection

@section('conteudo')

    <!-- CARD FILTROS -->
    <div class="card card-default">
        <div class="card-header">
            <a class="float-right" href="#" data-tool="card-collapse" data-toggle="tooltip">
                <em class="fa fa-minus"></em>
            </a>
            <div class="card-title"><i class="fas fa-filter"></i>Filtros</div>
        </div>
        <div class="card-wrapper collapse show">
            <div class="card-body">
                <div class="form-group">
                    <label for="filtroDescricao">Descrição</label>
                    <input type="text" class="form-control" name="filtroDescricao" id="filtroDescricao">
                </div>
                <div class="form-group">
                    <label for="filtroPrioridade">Prioridade</label>
                    <select class="form-control" name="filtroPrioridade" id="filtroPrioridade">
                        <option value="._.">Selecione Uma Prioridade</option>
                        @foreach($prioridades as $prioridade)
                            <option
                                value="{{ $prioridade->prioridade_codigo }}">{{ $prioridade->prioridade_descricao }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary btnPesquisa float-right mt-3 mb-3" value="Pesquisar"><i
                        class="fas fa-search"></i> Pesquisar
                </button>
            </div>
        </div>
    </div>
    <!-- FIM CARD FILTROS -->

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                <a class="btn btn-primary float-right mt-3 mb-3" href="{{ route('categorias.create') }}"><i class="fas fa-plus"></i> Nova Categoria </a>
                <table class="table table-bordered table-striped table-hover tabela_categorias">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Prioridade</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="float-right mt-5 links"></div>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')

	@include('categorias.script')
	
    <script>

        $(function() {
            $('.cardConteudo').fadeOut();
        });

        $(document).ready(function () {

            $('.btnPesquisa').click(function () {
				auxfn_do_ajax("{{route('categorias.index')}}", '', lista.do_alimenta_tabela, null)
            });
		});
    </script>
@endsection
