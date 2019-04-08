@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Categorias de Chamados
@endsection

@section('conteudo')

    <!-- CARD FILTROS -->
    <div class="card card-default">
        <div class="card-header">
            <a class="float-right" href="#" data-tool="card-collapse" data-toggle="tooltip">
                <em class="fa fa-plus"></em>
            </a>
            <div class="card-title" style="font-size: 12px;"><i class="fas fa-filter"></i>Filtros</div>
        </div>
        <div class="card-wrapper collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroDescricao">Descrição</label>
                            <input type="text" class="form-control" name="filtroDescricao" id="filtroDescricao">
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    </div>
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
            <div class="card-body table-responsive">

                @can('categorias.create')
                    <a class="btn btn-primary float-left mb-2" href="{{ route('categorias.create') }}"><i
                            class="fas fa-plus"></i> Nova Categoria </a>
                @endcan

                <table class="table table-sm table-bordered table-striped table-hover tabela_categorias">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Departamento</th>
                        <th>Prioridade</th>
                        @if(Auth::user()->can('categorias.edit') || Auth::user()->can('categorias.destroy'))
                            <th colspan="100">Ações</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="float-right mt-5 links">

                </div>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')

    @include('categorias.script')

    <script>
        $(document).ready(function () {

            $('.btnPesquisa').click(function () {
                lista.do_buscar();
            });

            $('.btnPesquisa ').click();

        });
    </script>
@endsection
